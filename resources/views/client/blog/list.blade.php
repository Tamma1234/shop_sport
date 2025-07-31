@extends('client.layouts.main')

@section('title', 'Blog List')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Blog List</h1>
            
            <div class="row">
                @for($i = 1; $i <= 6; $i++)
                <div class="col-12 mb-4">
                    <div class="article-blog type-space-2 hover-img4 d-flex">
                        <div class="col-md-4">
                            <a href="{{ route('client.blog.detail', 'sample-post-' . $i) }}" class="entry_image img-style4">
                                <img src="{{ asset('images/blog/blog-' . (4 + $i) . '.jpg') }}" data-src="{{ asset('images/blog/blog-' . (4 + $i) . '.jpg') }}" alt="Blog" class="lazyload aspect-ratio-0">
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="entry_tag">
                                <a href="#" class="name-tag h6 link">March {{ $i }}, 2025</a>
                            </div>
                            <div class="blog-content">
                                <a href="{{ route('client.blog.detail', 'sample-post-' . $i) }}" class="entry_name link h4">
                                    Sample Blog Post {{ $i }}
                                </a>
                                <p class="text h6">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit in malesuada magna faucibus. Pellentesque eget finibus nunc. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </p>
                                <a href="{{ route('client.blog.detail', 'sample-post-' . $i) }}" class="tf-btn-line">
                                    Read more
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection