@extends('client.layouts.main')

@section('title', 'Blog')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Blog</h1>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="article-blog type-space-2 hover-img4">
                        <a href="{{ route('client.blog.detail', 'sample-post-1') }}" class="entry_image img-style4">
                            <img src="{{ asset('images/blog/blog-5.jpg') }}" data-src="{{ asset('images/blog/blog-5.jpg') }}" alt="Blog" class="lazyload aspect-ratio-0">
                        </a>
                        <div class="entry_tag">
                            <a href="#" class="name-tag h6 link">March 2, 2025</a>
                        </div>
                        <div class="blog-content">
                            <a href="{{ route('client.blog.detail', 'sample-post-1') }}" class="entry_name link h4">
                                Skin Whitening With New Technology
                            </a>
                            <p class="text h6">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit in malesuada magna faucibus.
                            </p>
                            <a href="{{ route('client.blog.detail', 'sample-post-1') }}" class="tf-btn-line">
                                Read more
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="article-blog type-space-2 hover-img4">
                        <a href="{{ route('client.blog.detail', 'sample-post-2') }}" class="entry_image img-style4">
                            <img src="{{ asset('images/blog/blog-6.jpg') }}" data-src="{{ asset('images/blog/blog-6.jpg') }}" alt="Blog" class="lazyload aspect-ratio-0">
                        </a>
                        <div class="entry_tag">
                            <a href="#" class="name-tag h6 link">March 1, 2025</a>
                        </div>
                        <div class="blog-content">
                            <a href="{{ route('client.blog.detail', 'sample-post-2') }}" class="entry_name link h4">
                                Anti Aging With Vitamin C
                            </a>
                            <p class="text h6">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit in malesuada magna faucibus.
                            </p>
                            <a href="{{ route('client.blog.detail', 'sample-post-2') }}" class="tf-btn-line">
                                Read more
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="article-blog type-space-2 hover-img4">
                        <a href="{{ route('client.blog.detail', 'sample-post-3') }}" class="entry_image img-style4">
                            <img src="{{ asset('images/blog/blog-7.jpg') }}" data-src="{{ asset('images/blog/blog-7.jpg') }}" alt="Blog" class="lazyload aspect-ratio-0">
                        </a>
                        <div class="entry_tag">
                            <a href="#" class="name-tag h6 link">February 28, 2025</a>
                        </div>
                        <div class="blog-content">
                            <a href="{{ route('client.blog.detail', 'sample-post-3') }}" class="entry_name link h4">
                                Miraculous Uses Of Aloe Vera
                            </a>
                            <p class="text h6">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit in malesuada magna faucibus.
                            </p>
                            <a href="{{ route('client.blog.detail', 'sample-post-3') }}" class="tf-btn-line">
                                Read more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection