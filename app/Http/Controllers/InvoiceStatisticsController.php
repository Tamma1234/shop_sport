<?php

namespace App\Http\Controllers;

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
        $orders = Order::with(['orderItems.product', 'customer'])->get();

        $statistics = $orders->map(function ($order) {
            $totalSell = 0;
            $totalCost = 0;

            foreach ($order->orderItems as $item) {
                $totalSell += $item->price * $item->quantity;
                $totalCost += $item->product->cost_price * $item->quantity;
            }

            $customer = $order->customer;
            return [
                'order_code' => $order->order_code,
                'customer_name' => $customer ? $customer->name : 'Khách lẻ',
                'customer_email' => $customer ? $customer->email : null,
                'customer_phone' => $customer ? $customer->phone : null,
                'total_sell' => $totalSell,
                'total_cost' => $totalCost,
                'profit' => $totalSell - $totalCost,
                'created_at' => $order->created_at->format('d/m/Y H:i'),
            ];
        });

        $page = request()->get('page', 1);
        $perPage = 15;
        $items = collect($statistics); // đảm bảo là Collection

        $statistics = new LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        return view('statistics.index', compact('statistics'));
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
        //
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