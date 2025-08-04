@extends('client.layouts.main')

@section('title', 'Trang chủ')

@section('content')

@include('client.home.sections.marquee')
@include('client.home.sections.banner-slider')
@include('client.home.sections.banner-image')
@include('client.home.sections.collection')
@include('client.home.sections.trending')
@include('client.home.sections.image-view')
<!-- @include('client.home.sections.testimonial') -->
@include('client.home.sections.blog')
@include('client.home.sections.box-icon')
@endsection