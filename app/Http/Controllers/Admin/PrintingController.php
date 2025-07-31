<?php

namespace App\Http\Controllers\Admin;

use App\Models\Printing;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;

class PrintingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $printings = Printing::all();
        return view('admin.printings.index', compact('printings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.printings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $printing = Printing::create($validated);
        return redirect()->route('printings.index')->with('success', 'Tạo mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Printing $printing)
    {
        return view('admin.printings.show', compact('printing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Printing $printing)
    {
        return view('admin.printings.edit', compact('printing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Printing $printing)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $printing->update($validated);
        return redirect()->route('printings.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Printing $printing)
    {
        $printing->delete();
        return redirect()->route('printings.index')->with('success', 'Xóa thành công!');
    }
}
