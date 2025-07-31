@extends('client.layouts.main')

@section('title', 'Blog Detail')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Blog Detail: {{ $slug }}</h1>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="article-blog type-space-2">
                        <div class="entry_image img-style4 mb-4">
                            <img src="{{ asset('images/blog/blog-5.jpg') }}" data-src="{{ asset('images/blog/blog-5.jpg') }}" alt="Blog" class="lazyload aspect-ratio-0">
                        </div>
                        <div class="entry_tag">
                            <a href="#" class="name-tag h6 link">March 2, 2025</a>
                        </div>
                        <div class="blog-content">
                            <h2 class="entry_name h3 mb-3">Sample Blog Post Title</h2>
                            <p class="text h6 mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit in malesuada magna faucibus. Pellentesque eget finibus nunc. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                            <p class="text h6 mb-4">
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </p>
                            <p class="text h6 mb-4">
                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="sidebar">
                        <h4 class="mb-3">Recent Posts</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('client.blog.detail', 'sample-post-1') }}" class="text-decoration-none">Sample Post 1</a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('client.blog.detail', 'sample-post-2') }}" class="text-decoration-none">Sample Post 2</a>
                            </li>
                            <li class="mb-2">
                                <a href="{{ route('client.blog.detail', 'sample-post-3') }}" class="text-decoration-none">Sample Post 3</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection