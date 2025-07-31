@extends('admin.layouts.main')

@section('title', 'Chi Tiết Đơn Hàng - Thống Kê')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold tracking-tight">Chi Tiết Đơn Hàng</h2>
            <p class="text-muted-foreground">Thông tin chi tiết và thống kê đơn hàng</p>
        </div>
        <a href="{{ route('invoice-statistics.index') }}" class="inline-block px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded transition">← Quay lại danh sách</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Thông Tin Đơn Hàng</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <div><span class="font-semibold">Mã đơn hàng:</span> {{ $order->order_code }}</div>
                <div><span class="font-semibold">Ngày tạo:</span> {{ $order->created_at->format('d/m/Y H:i') }}</div>
                <div><span class="font-semibold">Trạng thái:</span> <span class="px-2 py-1 rounded text-xs {{ $order->status == 'completed' ? 'bg-green-100 text-green-700' : ($order->status == 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">{{ $order->status_label }}</span></div>
                <div><span class="font-semibold">Ghi chú:</span> {{ $order->note ?? '-' }}</div>
            </div>
            <div>
                <div><span class="font-semibold">Khách hàng:</span> {{ $order->customer ? $order->customer->name : 'Khách lẻ' }}</div>
                <div><span class="font-semibold">SĐT:</span> {{ $order->customer ? $order->customer->phone : '-' }}</div>
                <div><span class="font-semibold">Email:</span> {{ $order->customer ? $order->customer->email : '-' }}</div>
                <div><span class="font-semibold">Địa chỉ:</span> {{ $order->customer ? $order->customer->address : '-' }}</div>
            </div>
        </div>
        <div class="mb-6">
            <h4 class="font-semibold mb-2">Thống Kê Đơn Hàng</h4>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                <div class="bg-blue-50 p-3 rounded text-center">
                    <div class="text-xs text-gray-500">Tổng SL</div>
                    <div class="text-lg font-bold">{{ number_format($totalQuantity) }}</div>
                </div>
                <div class="bg-yellow-50 p-3 rounded text-center">
                    <div class="text-xs text-gray-500">Tổng Giá Nhập Kho</div>
                    <div class="text-lg font-bold">{{ number_format($totalWarehouse) }}</div>
                </div>
                <div class="bg-green-50 p-3 rounded text-center">
                    <div class="text-xs text-gray-500">Tổng Bán</div>
                    <div class="text-lg font-bold">{{ number_format($totalSell) }}</div>
                </div>
                <div class="bg-pink-50 p-3 rounded text-center">
                    <div class="text-xs text-gray-500">Tổng Tiền In</div>
                    <div class="text-lg font-bold">{{ number_format($printingCost) }}</div>
                </div>
                <div class="bg-orange-50 p-3 rounded text-center">
                    <div class="text-xs text-gray-500">Tổng Tiền Quà Tặng</div>
                    <div class="text-lg font-bold">{{ number_format($giftsCost) }}</div>
                </div>
                <div class="bg-purple-50 p-3 rounded text-center">
                    <div class="text-xs text-gray-500">Lợi Nhuận</div>
                    <div class="text-lg font-bold {{ $profit >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ number_format($profit) }}</div>
                </div>
            </div>
        </div>
        <div class="mb-6">
            <h4 class="font-semibold mb-2">Danh Sách Sản Phẩm</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STT</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên Sản Phẩm</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Số Lượng</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Giá Bán</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Tiền Cọc</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Giá Nhập Kho</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng Giá Nhập Kho</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">In Ấn</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($order->orderItems as $index => $item)
                        <tr>
                            <td class="px-4 py-4 align-middle">{{ $index + 1 }}</td>
                            <td class="px-4 py-4 align-middle">{{ $item->product ? $item->product->name : '-' }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($item->quantity) }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($item->price) }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($item->total) }}</td>
                            <td class="px-4 py-4 text-right align-middle">@if($index == 0){{ number_format($order->deposit) }}@endif</td>
                            <td class="px-4 py-4 text-right align-middle">{{ $item->product && isset($item->product->price_warehouse) ? number_format($item->product->price_warehouse) : '-' }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ $item->product && isset($item->product->price_warehouse) ? number_format($item->product->price_warehouse * $item->quantity) : '-' }}</td>
                            <td class="px-4 py-4 align-middle">
                                @php $print = $printingByProduct[$item->product_id] ?? null; @endphp
                                @if($print && count($print['styles']))
                                    <ul class="list-disc pl-4 mb-1">
                                        @foreach($print['styles'] as $style)
                                            <li>{{ $style['name'] }} ({{ number_format($style['price']) }} x {{ number_format($item->quantity) }} = <span class="font-semibold">{{ number_format($style['price'] * $item->quantity) }}</span>)</li>
                                        @endforeach
                                    </ul>
                                    <div class="text-xs text-gray-600">Tổng tiền in: <span class="font-semibold">{{ number_format($print['total']) }}</span></div>
                                @else
                                    <span class="italic text-gray-400">Không in</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        @if(count($giftsByOrder) > 0)
        <div class="mb-6">
            <h4 class="font-semibold mb-2">Quà Tặng</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STT</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên Quà Tặng</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Số Lượng</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Đơn Giá</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thành Tiền</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($giftsByOrder as $index => $gift)
                        <tr>
                            <td class="px-4 py-4 align-middle">{{ $index + 1 }}</td>
                            <td class="px-4 py-4 align-middle">{{ $gift['name'] }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($gift['quantity']) }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($gift['price']) }}</td>
                            <td class="px-4 py-4 text-right align-middle font-semibold">{{ number_format($gift['total']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-right font-medium">Tổng tiền quà tặng:</td>
                            <td class="px-4 py-4 font-bold text-lg">{{ number_format($giftsCost) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endif
        
        <!-- @if($order->printingStyles && $order->printingStyles->count())
        <div class="mb-6">
            <h4 class="font-semibold mb-2">Kiểu In</h4>
            <ul class="list-disc pl-6 mb-2">
                @foreach($order->printingStyles as $style)
                    <li>
                        {{ $style->name }} ({{ number_format($style->price) }} x {{ number_format($totalQuantity) }} = <span class="font-semibold">{{ number_format($style->price * $totalQuantity) }}</span>)
                    </li>
                @endforeach
            </ul>
            <div class="text-sm text-gray-600">Tổng tiền in: <span class="font-semibold">{{ number_format($printingCost) }}</span></div>
        </div>
        @endif -->
    </div>
</div>
@endsection 
