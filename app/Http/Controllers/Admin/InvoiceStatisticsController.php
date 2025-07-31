<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class InvoiceStatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tháng/năm từ request, mặc định là tháng hiện tại
        $selectedMonth = request()->get('month', now()->format('Y-m'));
        $month = \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth);
        
        // Lấy tất cả tháng/năm có dữ liệu để tạo dropdown
        $availableMonths = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month_year')
            ->distinct()
            ->orderBy('month_year', 'desc')
            ->pluck('month_year')
            ->map(function($monthYear) {
                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);
                return [
                    'value' => $monthYear,
                    'label' => $date->format('m/Y')
                ];
            });

        // Lọc đơn hàng theo tháng/năm được chọn
        $orders = Order::with(['orderItems.product', 'customer', 'orderItems.printingStyles', 'gifts'])
            ->whereYear('created_at', $month->year)
            ->whereMonth('created_at', $month->month)
            ->get();

        $statistics = $orders->map(function ($order) {
            $totalSell = 0;
            $totalCost = 0;
            $totalQuantity = 0;
            $totalWarehouse = 0;
            $printingCost = 0;
            $giftsCost = 0;
            foreach ($order->orderItems as $item) {
                $totalSell += $item->price * $item->quantity;
                $totalQuantity += $item->quantity;
                $totalCost += isset($item->product->cost_price) ? $item->product->cost_price * $item->quantity : 0;
                $totalWarehouse += isset($item->product->price_warehouse) ? $item->product->price_warehouse * $item->quantity : 0;
                // Tính tổng tiền in cho từng sản phẩm
                foreach ($item->printingStyles as $style) {
                    $printingCost += $style->price * $item->quantity;
                }
            }
            
            // Tính tổng tiền quà tặng
            foreach ($order->gifts as $gift) {
                $quantity = $gift->pivot->quantity ?? 1;
                $giftsCost += $gift->price * $quantity;
            }
            
            $customer = $order->customer;
            return [
                'order_id' => $order->id,
                'order_code' => $order->order_code,
                'customer_name' => $customer ? $customer->name : 'Khách lẻ',
                'customer_email' => $customer ? $customer->email : null,
                'customer_phone' => $customer ? $customer->phone : null,
                'total_sell' => $totalSell,
                'total_cost' => $totalCost,
                'total_warehouse' => $totalWarehouse,
                'total_quantity' => $totalQuantity,
                'printing_cost' => $printingCost,
                'gifts_cost' => $giftsCost,
                // Lợi nhuận = Tổng bán - Tổng giá nhập kho - Tổng tiền in - Tổng tiền quà tặng
                'profit' => $totalSell - $totalWarehouse - $printingCost - $giftsCost,
                'created_at' => $order->created_at->format('d/m/Y H:i'),
            ];
        });

        // Tính tổng hợp theo tháng
        $monthlyStats = [
            'total_orders' => $orders->count(),
            'total_sell' => $statistics->sum('total_sell'),
            'total_warehouse' => $statistics->sum('total_warehouse'),
            'total_printing' => $statistics->sum('printing_cost'),
            'total_gifts' => $statistics->sum('gifts_cost'),
            'total_profit' => $statistics->sum('profit'),
            'total_quantity' => $statistics->sum('total_quantity'),
        ];

        $page = request()->get('page', 1);
        $perPage = request()->get('per_page', 15);
        $items = collect($statistics); // đảm bảo là Collection
        $statistics = new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.statistics.index', compact('statistics', 'monthlyStats', 'availableMonths', 'selectedMonth'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = \App\Models\Order::with(['orderItems.product', 'customer', 'orderItems.printingStyles', 'gifts'])->findOrFail($id);
        $totalSell = 0;
        $totalCost = 0;
        $totalQuantity = 0;
        $totalWarehouse = 0;
        $printingCost = 0;
        $giftsCost = 0;
        $printingByProduct = [];
        $giftsByOrder = [];
        
        foreach ($order->orderItems as $item) {
            $totalSell += $item->price * $item->quantity;
            $totalQuantity += $item->quantity;
            $totalCost += isset($item->product->cost_price) ? $item->product->cost_price * $item->quantity : 0;
            $totalWarehouse += isset($item->product->price_warehouse) ? $item->product->price_warehouse * $item->quantity : 0;
            // Tính tiền in cho từng sản phẩm
            $itemPrinting = [];
            $itemPrintingTotal = 0;
            foreach ($item->printingStyles as $style) {
                $amount = $style->price * $item->quantity;
                $itemPrinting[] = [
                    'name' => $style->name,
                    'price' => $style->price,
                    'total' => $amount
                ];
                $itemPrintingTotal += $amount;
            }
            $printingByProduct[$item->product_id] = [
                'styles' => $itemPrinting,
                'total' => $itemPrintingTotal
            ];
            $printingCost += $itemPrintingTotal;
        }
        
        // Tính tiền quà tặng
        foreach ($order->gifts as $gift) {
            $quantity = $gift->pivot->quantity ?? 1;
            $giftTotal = $gift->price * $quantity;
            $giftsCost += $giftTotal;
            $giftsByOrder[] = [
                'name' => $gift->name,
                'price' => $gift->price,
                'quantity' => $quantity,
                'total' => $giftTotal
            ];
        }
        
        // Lợi nhuận = Tổng bán - Tổng giá nhập kho - Tổng tiền in - Tổng tiền quà tặng
        $profit = $totalSell - $totalWarehouse - $printingCost - $giftsCost;
        
        return view('admin.statistics.show', compact(
            'order', 
            'totalSell', 
            'totalCost', 
            'totalWarehouse', 
            'totalQuantity', 
            'profit', 
            'printingCost', 
            'printingByProduct',
            'giftsCost',
            'giftsByOrder'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
} 