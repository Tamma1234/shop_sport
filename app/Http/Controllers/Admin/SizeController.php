<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\Controller;

class SizeController extends Controller
{
    /**
     * Display a listing of the sizes.
     */
    public function index()
    {
        $sizes = Size::latest()->paginate(10);
        return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new size.
     */
    public function create()
    {
        return view('admin.sizes.create');
    }

    /**
     * Store a newly created size in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sizes',
            'description' => 'nullable|string|max:500',
            'status' => 'nullable|in:active,inactive'
        ]);

        try {
            DB::beginTransaction();

            Size::create([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'status' => $request->status ? 'active' : 'inactive'
            ]);

            DB::commit();

            return redirect()
                ->route('sizes.index')
                ->with('success', 'Kích thước đã được tạo thành công.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified size.
     */
    public function edit(Size $size)
    {
        return view('admin.sizes.edit', compact('size'));
    }

    /**
     * Update the specified size in storage.
     */
    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sizes,code,' . $size->id,
            'description' => 'nullable|string|max:500',
            'status' => 'nullable|in:active,inactive'
        ]);

        try {
            DB::beginTransaction();

            $size->update([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
                'status' => $request->status ? 'active' : 'inactive'
            ]);

            DB::commit();

            return redirect()
                ->route('sizes.index')
                ->with('success', 'Kích thước đã được cập nhật thành công.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified size from storage.
     */
    public function destroy(Size $size)
    {
        try {
            DB::beginTransaction();

            // Kiểm tra xem size có đang được sử dụng không
            if ($size->products()->exists()) {
                throw new \Exception('Không thể xóa kích thước này vì đang được sử dụng bởi một số sản phẩm.');
            }

            $size->delete();

            DB::commit();

            return redirect()
                ->route('sizes.index')
                ->with('success', 'Kích thước đã được xóa thành công.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
