@extends('admin.layouts.main')

@section('title', 'Dashboard - Soccer Store')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Tổng đơn hàng</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</p>
                </div>
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2-3-.895-3-2 1.343-2 3-2z"/>
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Tổng doanh thu</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($totalRevenue, 0, ',', '.') }}₫</p>
                </div>
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Khách hàng</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalCustomers }}</p>
                </div>
                <div class="p-3 bg-orange-100 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Sản phẩm</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
                </div>
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mt-8">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Đơn hàng mới nhất</h3>
            <p class="text-sm text-gray-600">5 đơn hàng gần đây nhất</p>
        </div>
        <div class="p-6 overflow-x-auto">
            @if($recentOrders->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Mã Đơn</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Khách Hàng</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SĐT</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tổng Tiền</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tiền Cọc</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Trạng Thái</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ngày Đặt</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Sản Phẩm</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentOrders as $order)
                    <tr>
                        <td class="px-4 py-2 font-semibold text-blue-700">{{ $order->order_code ?? $order->id }}</td>
                        <td class="px-4 py-2">{{ $order->customer->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2">{{ $order->customer->phone ?? '-' }}</td>
                        <td class="px-4 py-2 font-semibold">{{ number_format($order->total_amount, 0, ',', '.') }}₫</td>
                        <td class="px-4 py-2">{{ number_format($order->deposit, 0, ',', '.') }}₫</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                @elseif($order->status == 'completed') bg-green-100 text-green-800
                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ $order->status_label }}
                            </span>
                        </td>
                        <td class="px-4 py-2">{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : '-' }}</td>
                        <td class="px-4 py-2">
                            @if($order->orderItems && $order->orderItems->count())
                                <ul class="list-disc pl-4 text-xs">
                                    @foreach($order->orderItems as $item)
                                        <li>{{ $item->product->name ?? 'SP đã xóa' }} x {{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-gray-400 text-xs">Không có</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-gray-500">Không có đơn hàng nào.</p>
            @endif
        </div>
    </div>
</div>
@endsection 
