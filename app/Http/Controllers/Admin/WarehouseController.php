<?php

namespace App\Http\Controllers\Admin;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Admin\Controller;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::paginate(10);
        return view('admin.warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:255'
        ]);
        
        $validated['slug'] = Str::slug($validated['name'], '-');
        $warehouse = Warehouse::create($validated);

        return redirect()->route('warehouses.index')->with('success', 'Kho hàng đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('admin.warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view('admin.warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'phone' => 'required|string|max:255'
        ]);

        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update($validated);

        return redirect()->route('warehouses.index')->with('success', 'Kho hàng đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();
        return redirect()->route('warehouses.index')->with('success', 'Kho hàng đã được xóa thành công!');
    }
}
