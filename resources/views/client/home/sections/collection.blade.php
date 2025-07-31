<!-- Collection -->
<section class="themesFlat">
    <div class="container">
        <div class="sect-title text-center wow fadeInUp">
            <h1 class="title mb-8">Top Collection</h1>
            <p class="s-subtitle h6">Khám phá các danh mục sản phẩm bán chạy nhất</p>
        </div>
        <div dir="ltr" class="swiper tf-swiper wow fadeInUp" data-preview="5" data-tablet="4" data-mobile-sm="3" data-mobile="2"
            data-space-lg="40" data-space-md="32" data-space="12" data-pagination="2" data-pagination-sm="3" data-pagination-md="4"
            data-pagination-lg="5">
            <div class="swiper-wrapper">
                @forelse($topCategories as $index => $category)
                <div class="swiper-slide">
                    <a href="{{ route('client.products.category', $category->slug) }}" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            @if($category->image)
                                <img class="lazyload" src="{{ asset('storage/' . $category->image) }}" 
                                     data-src="{{ asset('storage/' . $category->image) }}" 
                                     alt="{{ $category->name }}">
                            @elseif($category->products->count() > 0 && $category->products->first()->image)
                                <img class="lazyload" src="{{ asset('storage/' . $category->products->first()->image) }}" 
                                     data-src="{{ asset('storage/' . $category->products->first()->image) }}" 
                                     alt="{{ $category->name }}">
                            @else
                                @php
                                    $defaultImages = [
                                        'images/collections/cls-10.jpg',
                                        'images/collections/cls-11.jpg', 
                                        'images/collections/cls-12.jpg',
                                        'images/collections/cls-13.jpg',
                                        'images/collections/cls-14.jpg'
                                    ];
                                    $imageIndex = $index % count($defaultImages);
                                @endphp
                                <img class="lazyload" src="{{ asset($defaultImages[$imageIndex]) }}" 
                                     data-src="{{ asset($defaultImages[$imageIndex]) }}" 
                                     alt="{{ $category->name }}">
                            @endif
                        </div>
                        <h5 class="collection_name fw-semibold link">{{ $category->name }}</h5>
                        <p class="text-sm text-muted">{{ $category->products_count }} sản phẩm</p>
                    </a>
                </div>
                @empty
                <!-- Fallback items khi không có dữ liệu -->
                <div class="swiper-slide">
                    <a href="#" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-10.jpg') }}" data-src="{{ asset('images/collections/cls-10.jpg') }}" alt="Danh mục">
                        </div>
                        <h5 class="collection_name fw-semibold link">Danh mục 1</h5>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-11.jpg') }}" data-src="{{ asset('images/collections/cls-11.jpg') }}" alt="Danh mục">
                        </div>
                        <h5 class="collection_name fw-semibold link">Danh mục 2</h5>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-12.jpg') }}" data-src="{{ asset('images/collections/cls-12.jpg') }}" alt="Danh mục">
                        </div>
                        <h5 class="collection_name fw-semibold link">Danh mục 3</h5>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-13.jpg') }}" data-src="{{ asset('images/collections/cls-13.jpg') }}" alt="Danh mục">
                        </div>
                        <h5 class="collection_name fw-semibold link">Danh mục 4</h5>
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="#" class="widget-collection hover-img type-space-2">
                        <div class="collection_image img-style rounded-0">
                            <img class="lazyload" src="{{ asset('images/collections/cls-14.jpg') }}" data-src="{{ asset('images/collections/cls-14.jpg') }}" alt="Danh mục">
                        </div>
                        <h5 class="collection_name fw-semibold link">Danh mục 5</h5>
                    </a>
                </div>
                @endforelse
            </div>
            <div class="sw-dot-default tf-sw-pagination"></div>
        </div>
    </div>
</section>
<!-- /Collection --> 