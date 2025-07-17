<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách danh mục
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo danh mục mới
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Lưu danh mục mới vào database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'slug' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:active,inactive'
        ]);

        // Tự động tạo slug nếu không có
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Mặc định status là active nếu không được gửi lên
        $validated['status'] = $request->has('status') ? 'active' : 'inactive';

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Danh mục đã được tạo thành công!');
    }

    /**
     * Hiển thị thông tin chi tiết danh mục
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Hiển thị form chỉnh sửa danh mục
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Cập nhật thông tin danh mục trong database
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$id,
            'slug' => 'required|string|max:255|unique:categories,slug,'.$id,
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:active,inactive'
        ]);

        // Tự động tạo slug nếu không có
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Cập nhật status dựa vào checkbox
        $validated['status'] = $request->has('status') ? 'active' : 'inactive';

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    /**
     * Xóa danh mục khỏi database
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Kiểm tra xem danh mục có sản phẩm không
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Không thể xóa danh mục này vì đang có sản phẩm thuộc danh mục!');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Danh mục đã được xóa thành công!');
    }
}
