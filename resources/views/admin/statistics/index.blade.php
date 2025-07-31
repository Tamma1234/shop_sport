@extends('admin.layouts.main')

@section('title', 'Thống Kê - Cửa Hàng Thể Thao')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold tracking-tight">Thống Kê Đơn Hàng</h2>
            <p class="text-muted-foreground">Xem thống kê lợi nhuận, doanh thu theo đơn hàng</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold">Danh Sách Thống Kê</h3>
                    <p class="text-gray-600">Danh sách thống kê các đơn hàng</p>
                </div>
                <div class="flex items-center space-x-4">
                    <label for="monthSelect" class="text-sm font-medium text-gray-700">Chọn tháng:</label>
                    <select id="monthSelect" name="month" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($availableMonths as $month)
                            <option value="{{ $month['value'] }}" @if($month['value'] == $selectedMonth) selected @endif>
                                {{ $month['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="p-6">
            <!-- Thống kê tổng hợp theo tháng -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold mb-4">Thống Kê Tháng {{ \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth)->format('m/Y') }}</h4>
                <div class="grid grid-cols-2 md:grid-cols-7 gap-4 mb-6">
                    <div class="bg-purple-50 p-3 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Đơn Hàng</div>
                        <div class="text-lg font-bold text-purple-600">{{ number_format($monthlyStats['total_orders']) }}</div>
                    </div>
                    <div class="bg-blue-50 p-3 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng SL</div>
                        <div class="text-lg font-bold text-blue-600">{{ number_format($monthlyStats['total_quantity']) }}</div>
                    </div>
                    <div class="bg-green-50 p-3 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Lợi Nhuận</div>
                        <div class="text-lg font-bold text-green-600">{{ number_format($monthlyStats['total_profit']) }}</div>
                    </div>
                    <div class="bg-yellow-50 p-3 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Giá Nhập Kho</div>
                        <div class="text-lg font-bold text-yellow-600">{{ number_format($monthlyStats['total_warehouse']) }}</div>
                    </div>
                    <div class="bg-indigo-50 p-3 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Tiền Bán</div>
                        <div class="text-lg font-bold text-indigo-600">{{ number_format($monthlyStats['total_sell']) }}</div>
                    </div>
                    <div class="bg-pink-50 p-3 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Tiền In</div>
                        <div class="text-lg font-bold text-pink-600">{{ number_format($monthlyStats['total_printing']) }}</div>
                    </div>
                    <div class="bg-orange-50 p-3 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Tiền Quà Tặng</div>
                        <div class="text-lg font-bold text-orange-600">{{ number_format($monthlyStats['total_gifts']) }}</div>
                    </div>
                </div>
            </div>

            <!-- Tổng hợp tất cả thời gian -->
            <div class="mb-6">
                <h4 class="text-lg font-semibold mb-4">Tổng Hợp Tất Cả Thời Gian</h4>
                @php
                    $totalProfit = $statistics->sum('profit');
                    $totalWarehouse = $statistics->sum('total_warehouse');
                    $totalSell = $statistics->sum('total_sell');
                    $totalPrinting = $statistics->sum('printing_cost');
                    $totalGifts = $statistics->sum('gifts_cost');
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                    <div class="bg-green-50 p-4 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Lợi Nhuận (đã trừ in & quà)</div>
                        <div class="text-2xl font-bold text-green-600">{{ number_format($totalProfit) }}</div>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Giá Nhập Kho</div>
                        <div class="text-2xl font-bold text-yellow-600">{{ number_format($totalWarehouse) }}</div>
                    </div>
                    <div class="bg-blue-50 p-4 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Tiền Bán</div>
                        <div class="text-2xl font-bold text-blue-600">{{ number_format($totalSell) }}</div>
                    </div>
                    <div class="bg-pink-50 p-4 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Tiền In</div>
                        <div class="text-2xl font-bold text-pink-600">{{ number_format($totalPrinting) }}</div>
                    </div>
                    <div class="bg-orange-50 p-4 rounded text-center">
                        <div class="text-xs text-gray-500">Tổng Tiền Quà Tặng</div>
                        <div class="text-2xl font-bold text-orange-600">{{ number_format($totalGifts) }}</div>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-2 mb-4">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Tìm kiếm theo mã đơn hoặc khách hàng..." class="max-w-sm px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[60px]">STT</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[120px]">Mã Đơn Hàng</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[140px]">Khách Hàng</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[80px]">Tổng SL</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[140px]">Tổng Giá Nhập Kho</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[120px]">Tổng Bán</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[120px]">Tổng Giá In</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[120px]">Tổng Quà Tặng</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[120px]">Lợi Nhuận</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[120px]">Ngày Tạo</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider min-w-[100px]">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="statisticsTableBody">
                        @forelse($statistics as $index => $stat)
                        <tr>
                            <td class="px-4 py-4 text-center font-medium align-middle">{{ ($statistics->currentPage() - 1) * $statistics->perPage() + $index + 1 }}</td>
                            <td class="px-4 py-4 text-left text-gray-500 align-middle">{{ $stat['order_code'] ?? '' }}</td>
                            <td class="px-4 py-4 text-left text-gray-500 align-middle">{{ $stat['customer_name'] }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($stat['total_quantity']) }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($stat['total_warehouse']) }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($stat['total_sell']) }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($stat['printing_cost']) }}</td>
                            <td class="px-4 py-4 text-right align-middle">{{ number_format($stat['gifts_cost']) }}</td>
                            <td class="px-4 py-4 text-right font-semibold align-middle {{ $stat['profit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ number_format($stat['profit']) }}</td>
                            <td class="px-4 py-4 text-center align-middle">{{ $stat['created_at'] }}</td>
                            <td class="px-4 py-4 text-center align-middle">
                                <a href="{{ isset($stat['order_id']) ? route('invoice-statistics.show', $stat['order_id']) : '#' }}" class="inline-block px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs rounded transition">Chi tiết đơn hàng</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="px-4 py-4 text-center text-gray-500">Không có dữ liệu thống kê.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-700">
                        Hiển thị {{ $statistics->firstItem() ?? 0 }} đến {{ $statistics->lastItem() ?? 0 }} trong tổng số {{ $statistics->total() }} bản ghi
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-700">Hiển thị:</span>
                        <select id="perPageSelect" class="px-2 py-1 border border-gray-300 rounded text-sm">
                            <option value="15" @if($statistics->perPage() == 15) selected @endif>15</option>
                            <option value="25" @if($statistics->perPage() == 25) selected @endif>25</option>
                            <option value="50" @if($statistics->perPage() == 50) selected @endif>50</option>
                            <option value="100" @if($statistics->perPage() == 100) selected @endif>100</option>
                        </select>
                        <span class="text-sm text-gray-700">bản ghi/trang</span>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $statistics->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('statisticsTableBody');
    const monthSelect = document.getElementById('monthSelect');

    // Xử lý thay đổi tháng
    monthSelect.addEventListener('change', function() {
        const selectedMonth = this.value;
        const currentUrl = new URL(window.location);
        currentUrl.searchParams.set('month', selectedMonth);
        currentUrl.searchParams.delete('page'); // Reset về trang 1 khi đổi tháng
        window.location.href = currentUrl.toString();
    });

    // Xử lý thay đổi số lượng bản ghi trên mỗi trang
    const perPageSelect = document.getElementById('perPageSelect');
    if (perPageSelect) {
        perPageSelect.addEventListener('change', function() {
            const perPage = this.value;
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('per_page', perPage);
            currentUrl.searchParams.delete('page'); // Reset về trang 1 khi đổi số lượng
            window.location.href = currentUrl.toString();
        });
    }

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr');

        rows.forEach(row => {
            // Nếu là dòng không có dữ liệu thì bỏ qua
            if(row.querySelectorAll('td').length < 10) return;
            const orderId = row.cells[1].textContent.toLowerCase();
            const orderCode = row.cells[2].textContent.toLowerCase();
            const customer = row.cells[3].textContent.toLowerCase();

            if (orderId.includes(searchTerm) || orderCode.includes(searchTerm) || customer.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
</script>

<style>
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1rem;
    gap: 0.25rem;
    flex-wrap: wrap;
}
.pagination .page-item {
    display: inline-block;
    margin: 0 1px;
}
.pagination .page-link {
    color: #2563eb;
    background: #f1f5f9;
    border: 1px solid #d1d5db;
    padding: 0.5rem 0.9rem;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
    min-width: 2.5rem;
    text-align: center;
    font-weight: 500;
}
.pagination .page-link:hover {
    background: #2563eb;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(37,99,235,0.2);
}
.pagination .active .page-link,
.pagination .page-link.active {
    background: #2563eb;
    color: #fff;
    border-color: #2563eb;
    font-weight: bold;
    box-shadow: 0 2px 8px rgba(37,99,235,0.3);
    transform: translateY(-1px);
}
.pagination .disabled .page-link {
    color: #9ca3af;
    background: #e5e7eb;
    cursor: not-allowed;
    opacity: 0.6;
}
.pagination .disabled .page-link:hover {
    transform: none;
    box-shadow: none;
}

/* Responsive pagination */
@media (max-width: 640px) {
    .pagination {
        gap: 0.125rem;
    }
    .pagination .page-link {
        padding: 0.375rem 0.75rem;
        min-width: 2rem;
        font-size: 0.875rem;
    }
}
</style>
@endsection
