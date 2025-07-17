@extends('layouts.main')

@section('title', 'Sản Phẩm - Cửa Hàng Thể Thao')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-3xl font-bold tracking-tight">Sản Phẩm</h2>
            <p class="text-muted-foreground">Quản lý kho sản phẩm thể thao</p>
        </div>
        <a href="{{ route('products.create') }}" id="addProductBtn" class="bg-gray-900 hover:bg-gray-900 text-white px-4 py-2 rounded-lg flex items-center">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Thêm Sản Phẩm
        </a>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold">Danh Sách Sản Phẩm</h3>
            <p class="text-gray-600">Danh sách tất cả sản phẩm trong cửa hàng</p>
        </div>
        <div class="p-6">
            <div class="flex items-center space-x-2 mb-4">
                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" id="searchInput" placeholder="Tìm kiếm sản phẩm..." class="max-w-sm px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên Sản Phẩm</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Danh Mục</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Giá</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tồn Kho</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày Tạo</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="productsTableBody">
                        @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $product->category->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ number_format($product->price, 0, ',', '.') }}₫</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $product->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="relative inline-block text-left">
                                    <button class="dropdown-toggle bg-transparent hover:bg-gray-100 p-2 rounded-md">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                        <a href="{{ route('products.edit', $product->id) }}" class="edit-btn block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <svg class="h-4 w-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Chỉnh Sửa
                                        </a>
                                        <button class="delete-btn block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                            <svg class="h-4 w-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Xóa
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown functionality
    document.querySelectorAll('.dropdown-toggle').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('hidden');
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.classList.add('hidden');
        });
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('productsTableBody');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr');

        rows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const category = row.cells[1].textContent.toLowerCase();

            if (name.includes(searchTerm) || category.includes(searchTerm)) {
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
