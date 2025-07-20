<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $warehouses = Warehouse::all();
        return view('products.create', compact('categories', 'warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
            $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'sku'             => 'nullable|string|max:255|unique:products,sku',
            'slug'            => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'discount_price'  => 'nullable|numeric|min:0|max:100',
            'stock'           => 'required|integer|min:0',
            'category_id'     => 'required|exists:categories,id',
            'warehouse_id'    => 'required|exists:warehouses,id',
            'tags'            => 'nullable|string|max:255',
            'price_warehouse' => 'nullable|numeric|min:0',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

    // 👇 Gán slug nếu chưa có
    $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name'], '-');
    $validated['tags'] = json_encode($request->tags);

    // 👇 Gán SKU nếu chưa nhập
    if (empty($validated['sku'])) {
        $validated['sku'] = $this->generateSKU($validated['name']);
    }


    // 👇 Xử lý ảnh
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('uploads/products', 'public');
    }

    Product::create($validated);

    return redirect()->route('products.index')->with('success', 'Sản phẩm đã được tạo thành công!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $warehouses = Warehouse::all();
        return view('products.edit', compact('product', 'categories', 'warehouses'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'nullable|string|max:255|unique:products,sku,' . $id,
            'slug'        => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|max:100',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'tags'        => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'price_warehouse' => 'nullable|numeric|min:0',
        ]);

      // 👇 Tự sinh slug nếu không nhập
    $validated['slug'] = $validated['slug'] ?? Str::slug($validated['name'], '-');
    $validated['tags'] = json_encode($request->tags);

    // 👇 Nếu không nhập SKU thì tự động sinh
    if (empty($validated['sku'])) {
        $validated['sku'] = $this->generateSKU($validated['name']);
    }
        // Xử lý cập nhật ảnh
        if ($request->hasFile('image')) {
            // Xoá ảnh cũ nếu có
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('image')->store('uploads/products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Xoá ảnh khỏi thư mục nếu tồn tại
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }

    protected function generateSKU($name)
{
    do {
        $sku = strtoupper(Str::slug($name)) . '-' . rand(100, 999);
    } while (\App\Models\Product::where('sku', $sku)->exists());

    return $sku;
}
}
