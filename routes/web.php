<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SizeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes for categories, products, and blog
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('warehouses', \App\Http\Controllers\WarehouseController::class)
        ->middleware(['auth', 'verified']);
    Route::resource('orders', OrderController::class);
    Route::resource('sizes', SizeController::class);
});

require __DIR__.'/auth.php';
