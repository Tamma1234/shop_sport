<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\BlogController;
use App\Http\Controllers\Client\NewsletterController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('client.home');

// Sản phẩm theo danh mục
Route::get('/products/category/{slug}', [ProductController::class, 'category'])->name('client.products.category');

// Chi tiết sản phẩm
Route::get('/products/detail/{id}', [ProductController::class, 'detail'])->name('client.products.detail');

// Trang giới thiệu
Route::get('/about', [AboutController::class, 'index'])->name('client.about');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('client.blog');
Route::get('/blog/grid', [BlogController::class, 'grid'])->name('client.blog.grid');
Route::get('/blog/list', [BlogController::class, 'list'])->name('client.blog.list');
Route::get('/blog/{slug}', [BlogController::class, 'detail'])->name('client.blog.detail');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe'); 