@extends('client.layouts.main')

@section('title', 'Blog Grid')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Blog Grid</h1>
            
            <div class="row">
                @for($i = 1; $i <= 9; $i++)
                <div class="col-md-4 mb-4">
                    <div class="article-blog type-space-2 hover-img4">
                        <a href="{{ route('client.blog.detail', 'sample-post-' . $i) }}" class="entry_image img-style4">
                            <img src="{{ asset('images/blog/blog-' . (4 + $i) . '.jpg') }}" data-src="{{ asset('images/blog/blog-' . (4 + $i) . '.jpg') }}" alt="Blog" class="lazyload aspect-ratio-0">
                        </a>
                        <div class="entry_tag">
                            <a href="#" class="name-tag h6 link">March {{ $i }}, 2025</a>
                        </div>
                        <div class="blog-content">
                            <a href="{{ route('client.blog.detail', 'sample-post-' . $i) }}" class="entry_name link h4">
                                Sample Blog Post {{ $i }}
                            </a>
                            <p class="text h6">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit in malesuada magna faucibus.
                            </p>
                            <a href="{{ route('client.blog.detail', 'sample-post-' . $i) }}" class="tf-btn-line">
                                Read more
                            </a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection