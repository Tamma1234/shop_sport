@extends('client.layouts.main')

@section('title', $category->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">{{ $category->name }}</h1>
            
            @if($products->count() > 0)
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card-product">
                            <div class="card-product_wrapper d-flex">
                                <a href="{{ route('client.products.detail', $product->id) }}" class="product-img">
                                    <img class="lazyload img-product" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
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
                    @endforeach
                </div>
                
                <div class="d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center">
                    <p>Không có sản phẩm nào trong danh mục này.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection