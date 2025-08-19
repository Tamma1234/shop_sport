@extends('client.layouts.main')

@section('title', $product->name)

<link rel="stylesheet" href="{{ asset('css/product-detail-fix.css') }}">

@section('content')
<!-- Page Title -->
<section class="s-page-title style-2">
    <div class="container">
        <div class="content">
            <ul class="breadcrumbs-page">
                <li><a href="{{ route('client.home') }}" class="h6 link">Trang chủ</a></li>
                <li class="d-flex"><i class="icon icon-caret-right"></i></li>
                @if($product->category)
                    <li><a href="{{ route('client.products.category', $product->category->slug) }}" class="h6 link">{{ $product->category->name }}</a></li>
                    <li class="d-flex"><i class="icon icon-caret-right"></i></li>
                @endif
                <li>
                    <h6 class="current-page fw-normal">{{ $product->name }}</h6>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Product Main -->
<section class="flat-single-product flat-spacing-3">
    <div class="tf-main-product section-image-zoom">
        <div class="container">
            <div class="row">
                <!-- Product Images -->
                <div class="col-md-6">
                    <div class="tf-product-media-wrap sticky-top">
                        <div class="product-thumbs-slider">
                            <div dir="ltr" class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical" data-preview="4.7">
                                <div class="swiper-wrapper stagger-wrap">
                                    <div class="swiper-slide stagger-item" data-size="XS" data-color="blue">
                                        <div class="item">
                                            @if($product->image)
                                                <img class="lazyload" data-src="{{ asset('storage/' . $product->image) }}" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                            @else
                                                <img class="lazyload" data-src="{{ asset('images/products/skincare/product-1.jpg') }}" src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="{{ $product->name }}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flat-wrap-media-product">
                                <div dir="ltr" class="swiper tf-product-media-main" id="gallery-swiper-started">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" data-size="XS" data-color="blue">
                                            <a href="{{ $product->image ? asset('storage/' . $product->image) : asset('images/products/skincare/product-1.jpg') }}" target="_blank" class="item" data-pswp-width="860px" data-pswp-height="1146px">
                                                <img class="tf-image-zoom lazyload" data-zoom="{{ $product->image ? asset('storage/' . $product->image) : asset('images/products/skincare/product-1.jpg') }}" data-src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/products/skincare/product-1.jpg') }}" src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/products/skincare/product-1.jpg') }}" alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Images -->
                
                <!-- Product Info -->
                <div class="col-md-6">
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-zoom-main sticky-top"></div>
                        <div class="tf-product-info-list other-image-zoom">
                            <h2 class="product-info-name">{{ $product->name }}</h2>
                            
                            <div class="product-info-meta">
                                <div class="rating">
                                    <div class="d-flex gap-4">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z" fill="#EF9122" />
                                        </svg>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z" fill="#EF9122" />
                                        </svg>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z" fill="#EF9122" />
                                        </svg>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z" fill="#EF9122" />
                                        </svg>
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 5.4091L8.913 5.07466L6.99721 0.261719L5.08143 5.07466L0 5.4091L3.89741 8.7184L2.61849 13.7384L6.99721 10.9707L11.376 13.7384L10.097 8.7184L14 5.4091Z" fill="#EF9122" />
                                        </svg>
                                    </div>
                                    <div class="reviews text-main">(5.0 đánh giá)</div>
                                </div>
                                <div class="people-add text-primary">
                                    <i class="icon icon-shopping-cart-simple"></i>
                                    <span class="h6">Sản phẩm chất lượng cao</span>
                                </div>
                            </div>
                            
                            <div class="tf-product-heading">
                                <div class="product-info-price price-wrap">
                                    @if($product->discount_price && $product->discount_price > 0)
                                        <span class="price-new price-on-sale h2 fw-4">{{ number_format($product->discount_price, 0, ',', '.') }}₫</span>
                                        <span class="price-old compare-at-price h6">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                        @php
                                            $discount_percent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                        @endphp
                                        <p class="badges-on-sale h6 fw-semibold">
                                            <span class="number-sale" data-person-sale="{{ $discount_percent }}">
                                                -{{ $discount_percent }}%
                                            </span>
                                        </p>
                                    @else
                                        <span class="price-new h2 fw-4">{{ number_format($product->price, 0, ',', '.') }}₫</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="tf-product-info-liveview">
                                <div class="liveview-count">
                                    <i class="icon icon-view"></i>
                                    <span class="count fw-6 h6">{{ $product->stock }}</span>
                                </div>
                                <p class="fw-6 h6">Sản phẩm có sẵn</p>
                            </div>
                            
                            <div class="tf-product-total-quantity">
                                <div class="group-btn">
                                    <div class="wg-quantity">
                                        <button class="btn-quantity btn-decrease">
                                            <i class="icon icon-minus"></i>
                                        </button>
                                        <input class="quantity-product" type="text" name="number" value="1" min="1" max="{{ $product->stock }}">
                                        <button class="btn-quantity btn-increase">
                                            <i class="icon icon-plus"></i>
                                        </button>
                                    </div>
                                    <a href="#shoppingCart" data-bs-toggle="offcanvas" class="tf-btn animate-btn btn-add-to-cart" data-product-id="{{ $product->id }}">
                                        THÊM VÀO GIỎ HÀNG
                                        <i class="icon icon-shopping-cart-simple"></i>
                                    </a>
                                    <button type="button" class="hover-tooltip box-icon btn-add-wishlist" data-product-id="{{ $product->id }}">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Thêm vào yêu thích</span>
                                    </button>
                                </div>
                                <a href="#checkout" class="tf-btn btn-primary w-100">MUA NGAY</a>
                            </div>
                            
                            <div class="tf-product-extra-link">
                                <a href="#askQuestion" data-bs-toggle="modal" class="product-extra-icon link">
                                    <i class="icon icon-ques"></i>Đặt câu hỏi
                                </a>
                                <a href="#shipAndDelivery" data-bs-toggle="modal" class="product-extra-icon link">
                                    <i class="icon icon-truck"></i>Giao hàng & Đổi trả
                                </a>
                                <a href="#shareWith" data-bs-toggle="modal" class="product-extra-icon link">
                                    <i class="icon icon-share"></i>Chia sẻ
                                </a>
                            </div>
                            
                            <div class="tf-product-delivery-return">
                                <div class="product-delivery">
                                    <div class="icon icon-clock-cd"></div>
                                    <p class="h6">Thời gian giao hàng dự kiến: <span class="fw-7 text-black">2-4 ngày</span> (Nội thành), <span class="fw-7 text-black">5-7 ngày</span> (Tỉnh thành khác).</p>
                                </div>
                                <div class="product-delivery return">
                                    <div class="icon icon-compare"></div>
                                    <p class="h6">Đổi trả trong vòng <span class="fw-7 text-black">30 ngày</span> kể từ ngày mua hàng.</p>
                                </div>
                            </div>
                            
                            <ul class="tf-product-cate-sku">
                                @if($product->sku)
                                    <li class="item-cate-sku h6">
                                        <span class="label fw-6 text-black">SKU:</span>
                                        <a href="#" class="value link text-main-2">{{ $product->sku }}</a>
                                    </li>
                                @endif
                                @if($product->category)
                                    <li class="item-cate-sku h6">
                                        <span class="label fw-6 text-black">Danh mục:</span>
                                        <span class="value text-main-2">{{ $product->category->name }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Product Info -->
            </div>
        </div>
    </div>
</section>
<!-- /Product Main -->

@if($relatedProducts->count() > 0)
<!-- Related Products -->
<section class="flat-related-products flat-spacing-3">
    <div class="container">
        <h3 class="section-title">Sản phẩm liên quan</h3>
        <div class="row">
            @foreach($relatedProducts as $relatedProduct)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product-card">
                    <div class="product-image">
                        <a href="{{ route('client.products.detail', $relatedProduct->id) }}">
                            @if($relatedProduct->image)
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="img-fluid">
                            @else
                                <img src="{{ asset('images/products/skincare/product-1.jpg') }}" alt="{{ $relatedProduct->name }}" class="img-fluid">
                            @endif
                        </a>
                    </div>
                    <div class="product-info">
                        <h4 class="product-title">
                            <a href="{{ route('client.products.detail', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a>
                        </h4>
                        <div class="product-price">
                            @if($relatedProduct->discount_price && $relatedProduct->discount_price > 0)
                                <span class="old-price">{{ number_format($relatedProduct->price, 0, ',', '.') }}₫</span>
                                <span class="current-price">{{ number_format($relatedProduct->discount_price, 0, ',', '.') }}₫</span>
                            @else
                                <span class="current-price">{{ number_format($relatedProduct->price, 0, ',', '.') }}₫</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Product Description -->
<section class="flat-spacing-3">
    <div class="container">
        <div class="flat-animate-tab tab-style-1">
            <ul class="menu-tab menu-tab-1" role="tablist">
                <li class="nav-tab-item" role="presentation">
                    <a href="#descriptions" class="tab-link active" data-bs-toggle="tab">Mô tả</a>
                </li>
                <li class="nav-tab-item" role="presentation">
                    <a href="#policy" class="tab-link" data-bs-toggle="tab">Chính sách giao hàng & đổi trả</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane wd-product-descriptions active show" id="descriptions" role="tabpanel">
                    <div class="tab-descriptions">
                        @if($product->description)
                            <p class="h6 desc">{{ $product->description }}</p>
                        @else
                            <p class="h6 desc">Sản phẩm chất lượng cao, được thiết kế với công nghệ hiện đại và nguyên liệu tốt nhất.</p>
                        @endif
                    </div>
                </div>
                <div class="tab-pane wd-product-descriptions" id="policy" role="tabpanel">
                    <div class="tab-policy">
                        <div class="mb_32">
                            <h5 class="mb_16 text-black">Đổi trả & Hoàn tiền:</h5>
                            <p class="h6">Chúng tôi chấp nhận đổi trả sản phẩm trong vòng 30 ngày kể từ ngày mua hàng. Sản phẩm phải còn nguyên vẹn, chưa sử dụng và có đầy đủ phụ kiện đi kèm.</p>
                        </div>
                        <div class="">
                            <h5 class="mb_16 text-black">Giao hàng:</h5>
                            <p class="h6">Chúng tôi giao hàng toàn quốc với thời gian từ 2-7 ngày tùy theo địa điểm. Miễn phí giao hàng cho đơn hàng từ 500.000₫ trở lên.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Product Description -->
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity controls
    const quantityInput = document.querySelector('.quantity-product');
    const decreaseBtn = document.querySelector('.btn-decrease');
    const increaseBtn = document.querySelector('.btn-increase');
    
    if (decreaseBtn && increaseBtn && quantityInput) {
        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
        
        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            let maxValue = parseInt(quantityInput.getAttribute('max'));
            if (currentValue < maxValue) {
                quantityInput.value = currentValue + 1;
            }
        });
    }
    
    // Add to cart functionality
    const addToCartBtn = document.querySelector('.btn-add-to-cart');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const quantity = document.querySelector('.quantity-product').value;
            
            // Add to cart logic here
            console.log('Adding product', productId, 'quantity', quantity);
            alert('Đã thêm sản phẩm vào giỏ hàng!');
        });
    }
    
    // Add to wishlist functionality
    const addToWishlistBtn = document.querySelector('.btn-add-wishlist');
    if (addToWishlistBtn) {
        addToWishlistBtn.addEventListener('click', function() {
            const productId = this.dataset.productId;
            
            // Add to wishlist logic here
            console.log('Adding product', productId, 'to wishlist');
            alert('Đã thêm sản phẩm vào danh sách yêu thích!');
        });
    }
});
</script>
@endsection 