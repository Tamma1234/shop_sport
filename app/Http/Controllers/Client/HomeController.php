<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        
        // Lấy các danh mục bán chạy với số lượng sản phẩm và sản phẩm mẫu
        $topCategories = Category::withCount(['products' => function($query) {
                $query->where('status', 'active');
            }])
            ->with(['products' => function($query) {
                $query->where('status', 'active')
                      ->orderBy('created_at', 'desc')
                      ->limit(1); // Lấy 1 sản phẩm mẫu
            }])
            ->whereHas('products', function($query) {
                $query->where('status', 'active');
            })
            ->orderBy('products_count', 'desc')
            ->limit(5)
            ->get();

        // Lấy sản phẩm cho trending section
        $newArrivals = Product::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $bestSellers = Product::where('status', 'active')
            ->orderBy('stock', 'desc') // Giả sử stock cao = bán chạy
            ->limit(8)
            ->get();

        $onSale = Product::where('status', 'active')
            ->whereNotNull('discount_price')
            ->where('discount_price', '>', 0)
            ->orderBy('discount_price', 'desc')
            ->limit(8)
            ->get();

        return view('client.home.home', compact('products', 'categories', 'topCategories', 'newArrivals', 'bestSellers', 'onSale'));
    }
}
