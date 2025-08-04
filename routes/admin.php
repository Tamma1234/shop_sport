<?php

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\PrintingController;
use App\Http\Controllers\Admin\PrintingStyleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\Admin\InvoiceStatisticsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\ContactInfoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('warehouses', WarehouseController::class)->middleware(['auth', 'verified']);
    Route::resource('orders', OrderController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('invoice-statistics', InvoiceStatisticsController::class);
    Route::resource('printings', PrintingController::class);
    Route::resource('printing-styles', PrintingStyleController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('gifts', GiftController::class);
    
    // Contact Info routes
    Route::get('/contact-info/edit', [ContactInfoController::class, 'edit'])->name('contact-info.edit');
    Route::put('/contact-info/update', [ContactInfoController::class, 'update'])->name('contact-info.update');
}); 