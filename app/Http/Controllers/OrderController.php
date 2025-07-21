<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Printing;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with(['orderItems.product', 'customer'])
        ->latest()
        ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $products = Product::all();

        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'shipping_address' => 'required|string',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'products' => 'required|array',
            'products.*.id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Tìm hoặc tạo khách hàng
            $customer = \App\Models\Customer::firstOrCreate(
                [
                    'phone' => $request->customer_phone,
                ],
                [
                    'name' => $request->customer_name,
                    'email' => $request->customer_email,
                    'address' => $request->shipping_address,
                    'note' => $request->notes,
                ]
            );

            // Tạo đơn hàng
            $order = \App\Models\Order::create([
                'customer_id' => $customer->id,
                'order_code' => \App\Models\Order::generateOrderCode(),
                'status' => $request->status,
                'total_amount' => 0, // sẽ cập nhật sau
                'note' => $request->notes,
            ]);

            // Thêm order items
            $total_amount = 0;
            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);
                $quantity = $item['quantity'];

                if ($product->stock < $quantity) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ số lượng trong kho.");
                }

                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'total' => $product->price * $quantity,
                ]);

                // Trừ kho
                $product->decrement('stock', $quantity);

                $total_amount += $product->price * $quantity;
            }

            // Cập nhật tổng tiền
            $order->update(['total_amount' => $total_amount]);

            // Lưu các kiểu in (kể cả khi không chọn gì)
            $order->printingStyles()->sync($request->input('printing_style_ids', []));

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Đơn hàng đã được tạo thành công.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $order->load(['orderItems.product']);
        $products = Product::where('stock', '>', 0)
            ->get();
        $printings = Printing::with('styles')->get();

        return view('orders.edit', compact('order', 'products', 'printings'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:cod,bank_transfer',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1'
        ]);

        try {
            DB::beginTransaction();

            // Update order details
            $order->update([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'shipping_address' => $request->shipping_address,
                'payment_method' => $request->payment_method,
                'status' => $request->status,
                'notes' => $request->notes,
                'deposit' => $request->deposit ? str_replace(['.', ','], '', $request->deposit) : 0,
            ]);

            // Restore stock for removed items
            foreach ($order->orderItems as $item) {
                if (!isset($request->quantities[$item->product_id])) {
                    $item->product->increment('stock', $item->quantity);
                }
            }

            // Remove all current items
            $order->orderItems()->delete();

            // Add new items
            $total_amount = 0;
            foreach ($request->quantities as $product_id => $quantity) {
                $product = Product::findOrFail($product_id);

                if ($product->stock < $quantity) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ số lượng trong kho.");
                }

                $order->orderItems()->create([
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);

                // Update stock
                $product->decrement('stock', $quantity);

                $total_amount += $product->price * $quantity;
            }

            // Update total amount
            $order->update(['total_amount' => $total_amount]);

            // Lưu các kiểu in (kể cả khi không chọn gì)
            $order->printingStyles()->sync($request->input('printing_style_ids', []));

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Đơn hàng đã được cập nhật thành công.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        try {
            DB::beginTransaction();

            // Restore product stock
            foreach ($order->orderItems as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            // Delete order and its items
            $order->orderItems()->delete();
            $order->delete();

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Đơn hàng đã được xóa thành công.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi xóa đơn hàng.');
        }
    }
}
