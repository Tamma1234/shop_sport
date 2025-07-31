<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Printing;
use App\Models\Product;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with(['orderItems.product', 'customer', 'gifts'])
        ->latest()
        ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $products = Product::all();
        $printings = Printing::with('styles')->get();
        $gifts = Gift::active()->get();
        return view('admin.orders.create', compact('products', 'printings', 'gifts'));
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
            'products.*.discounted_price' => 'required|numeric|min:0',
            'order_discount_type' => 'nullable|in:none,percentage,fixed',
            'order_discount_value' => 'nullable|numeric|min:0',
            'order_discount_reason' => 'nullable|string',
            'gifts' => 'nullable|array',
            'gift_quantities' => 'nullable|array',
            'gift_quantities.*' => 'nullable|integer|min:1',
            'deposit' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'printing_styles' => 'nullable|array',
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

            // Tính tổng tiền sản phẩm (sau giảm giá từng sản phẩm)
            $products_subtotal = 0;
            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);
                $quantity = $item['quantity'];
                $discounted_price = $item['discounted_price'];

                if ($product->stock < $quantity) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ số lượng trong kho.");
                }

                $products_subtotal += $discounted_price * $quantity;
            }

            // Tính giảm giá đơn hàng
            $order_discount_amount = 0;
            $order_discount_type = $request->input('order_discount_type', 'none');
            $order_discount_value = $request->input('order_discount_value', 0);

            if ($order_discount_type === 'percentage' && $order_discount_value > 0) {
                $order_discount_amount = ($products_subtotal * $order_discount_value) / 100;
            } elseif ($order_discount_type === 'fixed' && $order_discount_value > 0) {
                $order_discount_amount = $order_discount_value;
            }

            // Tính tổng tiền sau giảm giá đơn hàng
            $total_after_order_discount = $products_subtotal - $order_discount_amount;

            // Tạo đơn hàng
            $order = \App\Models\Order::create([
                'customer_id' => $customer->id,
                'order_code' => \App\Models\Order::generateOrderCode(),
                'status' => $request->status,
                'total_amount' => $total_after_order_discount,
                'note' => $request->notes,
                'deposit' => $request->deposit ? (int) str_replace(',', '', $request->deposit) : 0,
            ]);

            // Thêm order items với giá sau giảm giá
            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);
                $quantity = $item['quantity'];
                $discounted_price = $item['discounted_price'];

                $order->orderItems()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $discounted_price, // Lưu giá sau giảm giá
                    'total' => $discounted_price * $quantity,
                ]);

                // Trừ kho
                $product->decrement('stock', $quantity);
            }

            // Lưu quà tặng nếu có
            if ($request->has('gifts') && is_array($request->gifts)) {
                $giftData = [];
                foreach ($request->gifts as $giftId) {
                    $quantity = $request->input("gift_quantities.{$giftId}", 1);
                    $gift = Gift::find($giftId);
                    if ($gift) {
                        $giftData[$giftId] = [
                            'quantity' => $quantity,
                            'price' => $gift->price
                        ];
                    }
                }
                $order->gifts()->sync($giftData);
            }

            // Lưu thông tin giảm giá đơn hàng vào note nếu có
            if ($order_discount_amount > 0) {
                $discount_note = "Giảm giá đơn hàng: ";
                if ($order_discount_type === 'percentage') {
                    $discount_note .= "{$order_discount_value}% (-" . number_format($order_discount_amount, 0, ',', '.') . "₫)";
                } else {
                    $discount_note .= "-" . number_format($order_discount_amount, 0, ',', '.') . "₫";
                }
                
                if ($request->order_discount_reason) {
                    $discount_note .= " - Lý do: {$request->order_discount_reason}";
                }
                
                $current_note = $order->note ? $order->note . "\n" : "";
                $order->update(['note' => $current_note . $discount_note]);
            }

            // Lưu các kiểu in cho từng sản phẩm
            $printingStylesInput = $request->input('printing_styles', []); // [product_id => [style_id, ...]]
            foreach ($printingStylesInput as $product_id => $styleIds) {
                $orderItem = $order->orderItems()->where('product_id', $product_id)->first();
                if ($orderItem) {
                    $orderItem->printingStyles()->sync($styleIds);
                }
            }

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
        $order->load(['orderItems.product', 'orderItems.printingStyles', 'gifts']);
        $products = Product::where('stock', '>', 0)
            ->get();
        $printings = Printing::with('styles')->get();
        $gifts = Gift::active()->get();

        return view('admin.orders.edit', compact('order', 'products', 'printings', 'gifts'));
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
            'status' => 'required|in:pending,processing,completed,cancelled',
            'products' => 'required|array',
            'products.*.id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.discounted_price' => 'required|numeric|min:0',
            'order_discount_type' => 'nullable|in:none,percentage,fixed',
            'order_discount_value' => 'nullable|numeric|min:0',
            'order_discount_reason' => 'nullable|string',
            'gifts' => 'nullable|array',
            'gift_quantities' => 'nullable|array',
            'gift_quantities.*' => 'nullable|integer|min:1',
            'deposit' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'printing_styles' => 'nullable|array',
        ]);

        try {
            DB::beginTransaction();

            // Restore stock for removed items
            foreach ($order->orderItems as $item) {
                $item->product->increment('stock', $item->quantity);
            }

            // Tính tổng tiền sản phẩm (sau giảm giá từng sản phẩm)
            $products_subtotal = 0;
            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);
                $quantity = $item['quantity'];
                $discounted_price = $item['discounted_price'];

                if ($product->stock < $quantity) {
                    throw new \Exception("Sản phẩm {$product->name} không đủ số lượng trong kho.");
                }

                $products_subtotal += $discounted_price * $quantity;
            }

            // Tính giảm giá đơn hàng
            $order_discount_amount = 0;
            $order_discount_type = $request->input('order_discount_type', 'none');
            $order_discount_value = $request->input('order_discount_value', 0);

            if ($order_discount_type === 'percentage' && $order_discount_value > 0) {
                $order_discount_amount = ($products_subtotal * $order_discount_value) / 100;
            } elseif ($order_discount_type === 'fixed' && $order_discount_value > 0) {
                $order_discount_amount = $order_discount_value;
            }

            // Tính tổng tiền sau giảm giá đơn hàng
            $total_after_order_discount = $products_subtotal - $order_discount_amount;

            // Update order details
            $order->update([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email,
                'shipping_address' => $request->shipping_address,
                'status' => $request->status,
                'total_amount' => $total_after_order_discount,
                'deposit' => $request->deposit ? (int) str_replace(',', '', $request->deposit) : 0,
                'note' => $request->notes,
            ]);

            // Nếu có customer_id, cập nhật thông tin customer
            if ($order->customer_id) {
                $customer = \App\Models\Customer::find($order->customer_id);
                if ($customer) {
                    $customer->update([
                        'name' => $request->customer_name,
                        'email' => $request->customer_email,
                        'address' => $request->shipping_address,
                        'phone' => $request->customer_phone,
                    ]);
                }
            }

            // Remove all current items
            $order->orderItems()->delete();

            // Add new items with discounted prices
            $orderItemMap = [];
            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['id']);
                $quantity = $item['quantity'];
                $discounted_price = $item['discounted_price'];

                $orderItem = $order->orderItems()->create([
                    'product_id' => $item['id'],
                    'quantity' => $quantity,
                    'price' => $discounted_price,
                    'total' => $discounted_price * $quantity,
                ]);
                $orderItemMap[$item['id']] = $orderItem;

                // Trừ kho
                $product->decrement('stock', $quantity);
            }

            // Lưu quà tặng nếu có
            if ($request->has('gifts') && is_array($request->gifts)) {
                $giftData = [];
                foreach ($request->gifts as $giftId) {
                    $quantity = $request->input("gift_quantities.{$giftId}", 1);
                    $gift = Gift::find($giftId);
                    if ($gift) {
                        $giftData[$giftId] = [
                            'quantity' => $quantity,
                            'price' => $gift->price
                        ];
                    }
                }
                $order->gifts()->sync($giftData);
            } else {
                // Xóa tất cả quà tặng nếu không chọn
                $order->gifts()->detach();
            }

            // Lưu thông tin giảm giá đơn hàng vào note nếu có
            if ($order_discount_amount > 0) {
                $discount_note = "Giảm giá đơn hàng: ";
                if ($order_discount_type === 'percentage') {
                    $discount_note .= "{$order_discount_value}% (-" . number_format($order_discount_amount, 0, ',', '.') . "₫)";
                } else {
                    $discount_note .= "-" . number_format($order_discount_amount, 0, ',', '.') . "₫";
                }
                
                if ($request->order_discount_reason) {
                    $discount_note .= " - Lý do: {$request->order_discount_reason}";
                }
                
                $current_note = $order->note ? $order->note . "\n" : "";
                $order->update(['note' => $current_note . $discount_note]);
            }

            // Lưu các kiểu in cho từng sản phẩm
            $printingStylesInput = $request->input('printing_styles', []); // [product_id => [style_id, ...]]
            foreach ($printingStylesInput as $product_id => $styleIds) {
                if (isset($orderItemMap[$product_id])) {
                    $orderItemMap[$product_id]->printingStyles()->sync($styleIds);
                }
            }

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

            // Delete order relationships
            $order->orderItems()->delete();
            $order->gifts()->detach(); // Xóa liên kết quà tặng
            $order->printingStyles()->detach(); // Xóa liên kết kiểu in

            // Delete order
            $order->delete();

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Đơn hàng đã được xóa thành công.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi xóa đơn hàng: ' . $e->getMessage());
        }
    }
}
