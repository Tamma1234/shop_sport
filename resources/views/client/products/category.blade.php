@extends('client.layouts.main')

@section('title', $category->name)

@section('content')
  <style>
    .hidden { display: none !important; }
    .active { background-color: #007bff; color: white; }
    .meta-filter-shop { display: none; }
    .meta-filter-shop.active { display: block; }
    .wg-pagination { display: flex; justify-content: center; }
  </style>
  
  <!-- Page Title -->
  <section class="s-page-title">
            <div class="container">
                <div class="content">
                    <h1 class="title-page">{{ $category->name }}</h1>
                    <ul class="breadcrumbs-page">
                        <li><a href="{{ route('client.home') }}" class="h6 link">Home</a></li>
                        <li class="d-flex"><i class="icon icon-caret-right"></i></li>
                        <li>
                            <h6 class="current-page fw-normal">{{ $category->name }}</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- /Page Title -->
        <!-- Section Product -->
        <div class="flat-spacing">
            <div class="container">
                <div class="tf-shop-control">
                    <div class="tf-control-filter">
                        <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="filterShop" class="tf-btn-filter">
                            <span class="icon icon-filter"></span><span class="text">Filter</span></a>
                    </div>
                    <ul class="tf-control-layout">
                        <li class="tf-view-layout-switch sw-layout-2" data-value-layout="tf-col-2">
                            <i class="icon-grid-2"></i>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-3 d-none d-md-flex" data-value-layout="tf-col-3">
                            <i class="icon-grid-3"></i>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-4 d-none d-xl-flex active" data-value-layout="tf-col-4">
                            <i class="icon-grid-4"></i>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-5 d-none d-xxl-flex" data-value-layout="tf-col-5">
                            <i class="icon-grid-5"></i>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-6 d-none d-xxl-flex" data-value-layout="tf-col-6">
                            <i class="icon-grid-6"></i>
                        </li>
                        <li class="br-line type-vertical"></li>
                        <li class="tf-view-layout-switch sw-layout-list list-layout" data-value-layout="list">
                            <i class="icon-list"></i>
                        </li>
                    </ul>
                    <div class="tf-control-sorting">
                        <p class="h6 d-none d-lg-block">Sort by:</p>
                        <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                            <div class="btn-select">
                                <span class="text-sort-value">Best Selling</span>
                                <span class="icon icon-caret-down"></span>
                            </div>
                            <div class="dropdown-menu">
                                <div class="select-item active remove-all-filters" data-sort-value="best-selling">
                                    <span class="text-value-item">Best Selling</span>
                                </div>
                                <div class="select-item" data-sort-value="a-z">
                                    <span class="text-value-item">Alphabetically, A-Z</span>
                                </div>
                                <div class="select-item" data-sort-value="z-a">
                                    <span class="text-value-item">Alphabetically, Z-A</span>
                                </div>
                                <div class="select-item" data-sort-value="price-low-high">
                                    <span class="text-value-item">Price, low to high</span>
                                </div>
                                <div class="select-item" data-sort-value="price-high-low">
                                    <span class="text-value-item">Price, high to low</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper-control-shop gridLayout-wrapper">
                    <div class="meta-filter-shop">
                        <div id="product-count-grid" class="count-text">{{ $products->total() }} products found</div>
                        <div id="product-count-list" class="count-text">{{ $products->total() }} products found</div>
                        <div id="applied-filters"></div>
                        <button id="remove-all" class="remove-all-filters" style="display: none;"><i class="icon icon-close"></i> Clear all</button>
                    </div>
                    
                    <!-- List Layout -->
                    <div class="tf-list-layout wrapper-shop" id="listLayout" style="display: none;">
                        @foreach($products as $product)
                        <!-- Product Item -->
                        <div class="card-product product-style_list loadItem" data-availability="{{ $product->stock > 0 ? 'In stock' : 'Out of Stock' }}" data-brand="{{ $product->category->name ?? 'Unknown' }}">
                            <div class="card-product_wrapper">
                                <a href="{{ route('client.products.detail', $product->id) }}" class="product-img">
                                    <img class="lazyload img-product" src="{{ asset('storage/' . $product->image) }}" data-src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}">
                                    <img class="lazyload img-hover" src="{{ asset('storage/' . $product->image) }}" data-src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}">
                                </a>
                                <ul class="product-action_list">
                                    <li>
                                        <a href="#compare" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon ">
                                            <span class="icon icon-compare"></span>
                                            <span class="tooltip">Compare</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#quickView" data-bs-toggle="modal" class="hover-tooltip tooltip-left box-icon">
                                            <span class="icon icon-view"></span>
                                            <span class="tooltip">Quick view</span>
                                        </a>
                                    </li>
                                </ul>
                                @if($product->discount_price && $product->discount_price < $product->price)
                                <div class="product-countdown">
                                    <div class="js-countdown cd-has-zero" data-timer="25472" data-labels="d : ,h : ,m : ,s"></div>
                                </div>
                                <ul class="product-badge_list">
                                    <li class="product-badge_item h6 hot">Sale</li>
                                </ul>
                                @endif
                            </div>
                            <div class="card-product_info">
                                <div class="product-info_list">
                                    <a href="{{ route('client.products.detail', $product->id) }}" class="name-product h3 link">{{ $product->name }}</a>
                                    <div class="price-wrap">
                                        @if($product->discount_price && $product->discount_price < $product->price)
                                            <span class="price-old h6 fw-normal">${{ number_format($product->price, 2) }}</span>
                                            <span class="price-new h6">${{ number_format($product->discount_price, 2) }}</span>
                                        @else
                                            <span class="price-new h6">${{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                    <div class="product-desc_list d-none d-sm-grid">
                                        <p class="product-desc">
                                            <span class="headline fw-bold">Description:</span> {{ Str::limit($product->description, 200) }}
                                        </p>
                                    </div>
                                </div>
                                <div class="product-action_list">
                                    <span class="h6">To buy, select <span class="fw-bold text-black">size</span></span>
                                    <div class="group-btn">
                                        <a href="#shoppingCart" data-bs-toggle="offcanvas" class="tf-btn animate-btn">
                                            Add to Cart
                                            <i class="icon icon-shopping-cart-simple"></i>
                                        </a>
                                        <a href="#" class="tf-btn style-line btn-add-wishlist2">
                                            <span class="text">Add to List</span>
                                            <i class="icon icon-heart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Pagination for List Layout -->
                        <div class="wd-full wg-pagination m-0 justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                    
                    <!-- Grid Layout -->
                    <div class="wrapper-shop tf-grid-layout tf-col-4" id="gridLayout">
                        @foreach($products as $product)
                        <!-- Product Item -->
                        <div class="card-product grid loadItem" data-availability="{{ $product->stock > 0 ? 'In stock' : 'Out of Stock' }}" data-brand="{{ $product->category->name ?? 'Unknown' }}">
                            <div class="card-product_wrapper">
                                <a href="{{ route('client.products.detail', $product->id) }}" class="product-img">
                                    <img class="lazyload img-product" src="{{ asset('storage/' . $product->image) }}" data-src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}">
                                    <img class="lazyload img-hover" src="{{ asset('storage/' . $product->image) }}" data-src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}">
                                </a>
                                <ul class="product-action_list">
                                    <li>
                                        <a href="#shoppingCart" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon">
                                            <span class="icon icon-shopping-cart-simple"></span>
                                            <span class="tooltip">Add to cart</span>
                                        </a>
                                    </li>
                                    <li class="wishlist">
                                        <a href="javascript:void(0);" class="hover-tooltip tooltip-left box-icon">
                                            <span class="icon icon-heart"></span>
                                            <span class="tooltip">Add to Wishlist</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#compare" data-bs-toggle="offcanvas" class="hover-tooltip tooltip-left box-icon ">
                                            <span class="icon icon-compare"></span>
                                            <span class="tooltip">Compare</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#quickView" data-bs-toggle="modal" class="hover-tooltip tooltip-left box-icon">
                                            <span class="icon icon-view"></span>
                                            <span class="tooltip">Quick view</span>
                                        </a>
                                    </li>
                                </ul>
                                @if($product->discount_price && $product->discount_price < $product->price)
                                <ul class="product-badge_list">
                                    <li class="product-badge_item flash-sale"><i class="icon icon-thunder"></i> Flash sale</li>
                                </ul>
                                @endif
                            </div>
                            <div class="card-product_info">
                                <a href="{{ route('client.products.detail', $product->id) }}" class="name-product h4 link">{{ $product->name }}</a>
                                <div class="price-wrap">
                                    @if($product->discount_price && $product->discount_price < $product->price)
                                        <span class="price-old h6 fw-normal">${{ number_format($product->price, 2) }}</span>
                                        <span class="price-new h6">${{ number_format($product->discount_price, 2) }}</span>
                                    @else
                                        <span class="price-new h6">${{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Pagination -->
                        <div class="wd-full wg-pagination m-0 justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Section Product -->
        
        <script>
            $(document).ready(function() {
                console.log('Category page loaded');
                console.log('Products found:', $('.card-product').length);
                console.log('List layout products:', $('#listLayout .card-product').length);
                console.log('Grid layout products:', $('#gridLayout .card-product').length);
                
                // Test sort functionality
                $('.select-item').on('click', function() {
                    console.log('Sort clicked:', $(this).data('sort-value'));
                });
                
                // Test layout switching
                $('.tf-view-layout-switch').on('click', function() {
                    console.log('Layout switched to:', $(this).data('value-layout'));
                });
            });
        </script>
@endsection 