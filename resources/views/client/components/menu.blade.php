<ul class="box-nav-menu">
    <li class="menu-item position-relative">
        <a href="{{ route('client.home') }}" class="item-link">TRANG CHỦ</a>
    </li>
    <li class="menu-item position-relative">
        <a href="{{ route('client.products.category', 'ao-bong-da') }}" class="item-link">ÁO BÓNG ĐÁ<i class="icon icon-caret-down"></i></a>
        <div class="sub-menu">
            <ul class="sub-menu_list">
                @foreach ($categories as $category)
                <li><a href="{{ route('client.products.category', $category->slug) }}" class="sub-menu_link">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </li>
    <li class="menu-item position-relative">
        <a href="{{ route('client.products.category', 'phu-kien') }}" class="item-link">PHỤ KIỆN<i class="icon icon-caret-down"></i></a>
    </li>
    <li class="menu-item position-relative">
        <a href="{{ route('client.products.category', 'ao-bong-chuyen') }}" class="item-link">ÁO BÓNG CHUYỀN</a>
    </li>
    <li class="menu-item position-relative">
        <a href="{{ route('client.products.category', 'ao-polo-dong-phuc') }}" class="item-link">ÁO POLO ĐỒNG PHỤC</a>
    </li>
    <li class="menu-item position-relative">
        <a href="{{ route('client.about') }}" class="item-link">GIỚI THIỆU</a>
    </li>
    <li class="menu-item position-relative">
        <a href="{{ route('client.blog') }}" class="item-link">BÀI VIẾT</a>
        <div class="sub-menu">
            <ul class="sub-menu_list">
                <li><a href="{{ route('client.blog.grid') }}" class="sub-menu_link">Blog Grid</a></li>
                <li><a href="{{ route('client.blog.list') }}" class="sub-menu_link">Blog List</a></li>
                <li><a href="{{ route('client.blog.detail', 'sample-post') }}" class="sub-menu_link">Blog Single</a></li>
            </ul>
        </div>
    </li>
</ul>