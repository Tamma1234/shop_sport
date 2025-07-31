<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController
{
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = Product::where('category_id', $category->id)->paginate(12);
        $categories = Category::all(); // Thêm biến categories cho menu
        
        return view('client.products.category', compact('category', 'products', 'categories'));
    }

    public function detail($id)
    {
        $product = Product::where('id', $id)
            ->where('status', 'active')
            ->firstOrFail();
        
        // Lấy sản phẩm liên quan (cùng danh mục)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();
        
        $categories = Category::all(); // Thêm biến categories cho menu
        
        return view('client.products.detail', compact('product', 'relatedProducts', 'categories'));
    }
}