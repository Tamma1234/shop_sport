@extends('layouts.main')

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
            <h3 class="text-lg font-semibold">Danh Sách Thống Kê</h3>
            <p class="text-gray-600">Danh sách thống kê các đơn hàng</p>
        </div>
        <div class="p-6">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">STT</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã Đơn Hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Khách Hàng</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng Bán</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tổng Vốn</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lợi Nhuận</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày Tạo</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="statisticsTableBody">
                        @forelse($statistics as $index => $stat)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ ($statistics->currentPage() - 1) * $statistics->perPage() + $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $stat['order_code'] ?? '' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $stat['customer_name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">{{ number_format($stat['total_sell']) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">{{ number_format($stat['total_cost']) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right font-semibold {{ $stat['profit'] >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ number_format($stat['profit']) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">{{ $stat['created_at'] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-4 py-4 text-center text-gray-500">Không có dữ liệu thống kê.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $statistics->links() }}
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('statisticsTableBody');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr');

        rows.forEach(row => {
            // Nếu là dòng không có dữ liệu thì bỏ qua
            if(row.querySelectorAll('td').length < 9) return;
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
    margin-top: 1rem;
    gap: 0.25rem;
}
.pagination .page-item {
    display: inline-block;
}
.pagination .page-link {
    color: #2563eb;
    background: #f1f5f9;
    border: 1px solid #d1d5db;
    padding: 0.5rem 0.9rem;
    border-radius: 0.375rem;
    margin: 0 2px;
    transition: background 0.2s, color 0.2s;
    text-decoration: none;
}
.pagination .page-link:hover {
    background: #2563eb;
    color: #fff;
}
.pagination .active .page-link,
.pagination .page-link.active {
    background: #2563eb;
    color: #fff;
    border-color: #2563eb;
    font-weight: bold;
    box-shadow: 0 2px 8px rgba(37,99,235,0.08);
}
.pagination .disabled .page-link {
    color: #9ca3af;
    background: #e5e7eb;
    cursor: not-allowed;
}
</style>
@endsection
