<div class="w-64 bg-white shadow-lg">
    <div class="p-6">
        <img src="{{ asset('build/assets/images/logo-tamjr.png') }}" alt="TamJR Sport Logo" class="h-10 mx-auto">
    </div>

    <nav class="mt-6">
        <div class="px-4 space-y-2">
            <a href="{{route('dashboard')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                    <path d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z" />
                </svg>
                Trang Chủ
            </a>
            <a href="{{route('products.index')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('products.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                Sản Phẩm
            </a>
            <a href="{{route('orders.index')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('orders.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Đơn Hàng
            </a>
            <a href="{{ route('invoice-statistics.index') }}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('invoice-statistics.index') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 17v-2a4 4 0 014-4h4" />
                    <path d="M3 17v-2a4 4 0 014-4h4" />
                    <circle cx="9" cy="7" r="4" />
                    <circle cx="17" cy="17" r="4" />
                </svg>
                Thống Kê Hóa Đơn
            </a>

            <a href="{{route('customers.index')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('customers.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                Khách Hàng
            </a>
            <a href="{{route('categories.index')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('categories.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                Danh Mục
            </a>
            <a href="{{route('sizes.index')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('sizes.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 8V4m0 0h4M4 4l5 5m11-2V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                </svg>
                Kích Thước
            </a>
            <a href="{{route('warehouses.index')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('warehouses.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
                Kho Hàng
            </a>
            <a href="{{route('printings.index')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('printings.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v14a2 2 0 01-2 2z" />
                    <path d="M9 17v-6h6v6" />
                </svg>
                In ấn
            </a>
            <a href="{{route('printing-styles.index')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('printing-styles.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M16 8a6 6 0 11-12 0 6 6 0 0112 0z" />
                    <path d="M2 20h12M7 16v4" />
                </svg>
                Kiểu in ấn
            </a>
            <a href="{{route('gifts.index')}}"
                class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('gifts.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                </svg>
                Quà Tặng
            </a>
        </div>
    </nav>
</div>
