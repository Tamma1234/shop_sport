    <!-- Trending -->
    <section class="flat-spacing flat-animate-tab">
            <div class="container">
                <div class="sect-title wow fadeInUp">
                    <h1 class="title text-center mb-24">Trending Shop</h1>
                    <ul class="tab-product_list" role="tablist">
                        <li class="nav-tab-item" role="presentation">
                            <a href="#new-arr" data-bs-toggle="tab" class="tf-btn-line tf-btn-tab active">
                                NEW ARRIVALS
                            </a>
                        </li>
                        <li class="nav-tab-item" role="presentation">
                            <a href="#best-seller" data-bs-toggle="tab" class="tf-btn-line tf-btn-tab">
                                Best seller
                            </a>
                        </li>
                        <li class="nav-tab-item" role="presentation">
                            <a href="#on-sale" data-bs-toggle="tab" class="tf-btn-line tf-btn-tab">
                                On sale
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="tab-content">
                    <div class="tab-pane active show" id="new-arr" role="tabpanel">
                        <div dir="ltr" class="swiper tf-swiper wow fadeInUp" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="2"
                            data-space-lg="48" data-space-md="30" data-space="12" data-pagination="2" data-pagination-sm="2" data-pagination-md="3"
                            data-pagination-lg="4" data-grid="2">
                            <div class="swiper-wrapper">
                                @forelse($newArrivals as $product)
                                <div class="swiper-slide">
                                    <div class="card-product">
                                        <div class="card-product_wrapper d-flex">
                                            <a href="{{ route('client.products.detail', $product->id) }}" class="product-img">
                                                @if($product->image)
                                                    <img class="lazyload img-product" src="{{ asset('storage/' . $product->image) }}"
                                                        data-src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                    <img class="lazyload img-hover" src="{{ asset('storage/' . $product->image) }}"
                                                        data-src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                @else
                                                    <img class="lazyload img-product" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                        data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="{{ $product->name }}">
                                                    <img class="lazyload img-hover" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                        data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="{{ $product->name }}">
                                                @endif
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
                                                <li class="compare">
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
                                        </div>
                                        <div class="card-product_info">
                                            <a href="{{ route('client.products.detail', $product->id) }}" class="name-product h4 link">{{ $product->name }}</a>
                                            <div class="price-wrap mb-0">
                                                @if($product->discount_price && $product->discount_price > 0)
                                                    <span class="price-old h6 fw-normal">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                                    <span class="price-new h6">{{ number_format($product->discount_price, 0, ',', '.') }}₫</span>
                                                @else
                                                    <span class="price-new h6">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <!-- Fallback products khi không có dữ liệu -->
                                <div class="swiper-slide">
                                    <div class="card-product">
                                        <div class="card-product_wrapper d-flex">
                                            <a href="#" class="product-img">
                                                <img class="lazyload img-product" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                    data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="Product">
                                                <img class="lazyload img-hover" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                    data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="Product">
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
                                                <li class="compare">
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
                                        </div>
                                        <div class="card-product_info">
                                            <a href="#" class="name-product h4 link">Sản phẩm mẫu</a>
                                            <div class="price-wrap mb-0">
                                                <span class="price-new h6">500,000₫</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                            <div class="sw-dot-default tf-sw-pagination"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="best-seller" role="tabpanel">
                        <div dir="ltr" class="swiper tf-swiper" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="2" data-space-lg="48"
                            data-space-md="30" data-space="12" data-pagination="2" data-pagination-sm="2" data-pagination-md="3"
                            data-pagination-lg="4" data-grid="2">
                            <div class="swiper-wrapper">
                                @forelse($bestSellers as $product)
                                <div class="swiper-slide">
                                    <div class="card-product">
                                        <div class="card-product_wrapper d-flex">
                                            <a href="{{ route('client.products.detail', $product->id) }}" class="product-img">
                                                @if($product->image)
                                                    <img class="lazyload img-product" src="{{ asset('storage/' . $product->image) }}"
                                                        data-src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                    <img class="lazyload img-hover" src="{{ asset('storage/' . $product->image) }}"
                                                        data-src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                @else
                                                    <img class="lazyload img-product" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                        data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="{{ $product->name }}">
                                                    <img class="lazyload img-hover" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                        data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="{{ $product->name }}">
                                                @endif
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
                                                <li class="compare">
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
                                        </div>
                                        <div class="card-product_info">
                                            <a href="{{ route('client.products.detail', $product->id) }}" class="name-product h4 link">{{ $product->name }}</a>
                                            <div class="price-wrap mb-0">
                                                @if($product->discount_price && $product->discount_price > 0)
                                                    <span class="price-old h6 fw-normal">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                                    <span class="price-new h6">{{ number_format($product->discount_price, 0, ',', '.') }}₫</span>
                                                @else
                                                    <span class="price-new h6">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <!-- Fallback products khi không có dữ liệu -->
                                <div class="swiper-slide">
                                    <div class="card-product">
                                        <div class="card-product_wrapper d-flex">
                                            <a href="#" class="product-img">
                                                <img class="lazyload img-product" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                    data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="Product">
                                                <img class="lazyload img-hover" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                    data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="Product">
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
                                                <li class="compare">
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
                                        </div>
                                        <div class="card-product_info">
                                            <a href="#" class="name-product h4 link">Sản phẩm bán chạy</a>
                                            <div class="price-wrap mb-0">
                                                <span class="price-new h6">500,000₫</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                            <div class="sw-dot-default tf-sw-pagination"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="on-sale" role="tabpanel">
                        <div dir="ltr" class="swiper tf-swiper" data-preview="4" data-tablet="3" data-mobile-sm="2" data-mobile="2" data-space-lg="48"
                            data-space-md="30" data-space="12" data-pagination="2" data-pagination-sm="2" data-pagination-md="3"
                            data-pagination-lg="4" data-grid="2">
                            <div class="swiper-wrapper">
                                @forelse($onSale as $product)
                                <div class="swiper-slide">
                                    <div class="card-product">
                                        <div class="card-product_wrapper d-flex">
                                            <a href="{{ route('client.products.detail', $product->id) }}" class="product-img">
                                                @if($product->image)
                                                    <img class="lazyload img-product" src="{{ asset('storage/' . $product->image) }}"
                                                        data-src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                    <img class="lazyload img-hover" src="{{ asset('storage/' . $product->image) }}"
                                                        data-src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                @else
                                                    <img class="lazyload img-product" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                        data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="{{ $product->name }}">
                                                    <img class="lazyload img-hover" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                        data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="{{ $product->name }}">
                                                @endif
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
                                                <li class="compare">
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
                                        </div>
                                        <div class="card-product_info">
                                            <a href="{{ route('client.products.detail', $product->id) }}" class="name-product h4 link">{{ $product->name }}</a>
                                            <div class="price-wrap mb-0">
                                                @if($product->discount_price && $product->discount_price > 0)
                                                    <span class="price-old h6 fw-normal">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                                    <span class="price-new h6">{{ number_format($product->discount_price, 0, ',', '.') }}₫</span>
                                                @else
                                                    <span class="price-new h6">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <!-- Fallback products khi không có dữ liệu -->
                                <div class="swiper-slide">
                                    <div class="card-product">
                                        <div class="card-product_wrapper d-flex">
                                            <a href="#" class="product-img">
                                                <img class="lazyload img-product" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                    data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="Product">
                                                <img class="lazyload img-hover" src="{{ asset('images/products/skincare/product-1.jpg') }}"
                                                    data-src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="Product">
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
                                                <li class="compare">
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
                                        </div>
                                        <div class="card-product_info">
                                            <a href="#" class="name-product h4 link">Sản phẩm khuyến mãi</a>
                                            <div class="price-wrap mb-0">
                                                <span class="price-old h6 fw-normal">500,000₫</span>
                                                <span class="price-new h6">400,000₫</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                            <div class="sw-dot-default tf-sw-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Trending -->