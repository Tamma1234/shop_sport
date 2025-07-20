<div class="w-64 bg-white shadow-lg">
    <div class="p-6">
        <h1 class="text-2xl font-bold text-gray-900">Trùm Áo Bóng Đá</h1>
    </div>

    <nav class="mt-6">
        <div class="px-4 space-y-2">
            <a href="{{route('dashboard')}}"
               class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                    <path d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"/>
                </svg>
                Trang Chủ
            </a>
            <a href="{{route('products.index')}}"
               class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('products.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Sản Phẩm
            </a>
            <a href="{{route('orders.index')}}"
               class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('orders.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Đơn Hàng
            </a>
            <a href="#"
               class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('customers.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
                Khách Hàng
            </a>
            <a href="{{route('categories.index')}}"
               class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('categories.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
                Danh Mục
            </a>
            <a href="{{route('sizes.index')}}"
               class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('sizes.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M4 8V4m0 0h4M4 4l5 5m11-2V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                </svg>
                Kích Thước
            </a>
            <a href="{{route('warehouses.index')}}"
               class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('warehouses.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                </svg>
                Kho Hàng
            </a>
            <a href="#"
               class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('statistics.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Thống Kê
            </a>
            <a href="#"
               class="sidebar-item flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('settings.*') ? 'bg-blue-100 text-blue-700 font-bold' : 'text-gray-600 hover:text-gray-900' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Cài Đặt
            </a>
        </div>
    </nav>
</div>
