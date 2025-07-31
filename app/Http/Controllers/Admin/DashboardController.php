<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Http\Controllers\Admin\Controller;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     */
    public function index()
    {
        // Thống kê
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_amount');
        $totalCustomers = Customer::count();
        $totalProducts = Product::count();

        // 5 đơn hàng mới nhất
        $recentOrders = Order::with('customer')->orderByDesc('created_at')->take(5)->get();

        return view('admin.dashboard.index', [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'totalCustomers' => $totalCustomers,
            'totalProducts' => $totalProducts,
            'recentOrders' => $recentOrders,
        ]);
    }
} 