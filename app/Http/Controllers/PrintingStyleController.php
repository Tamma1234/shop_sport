<?php

namespace App\Http\Controllers;

use App\Models\PrintingStyle;
use Illuminate\Http\Request;

class PrintingStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $printing_styles = PrintingStyle::with('printing')->get();
        return view('printing_styles.index', compact('printing_styles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $printings = \App\Models\Printing::all();
        return view('printing_styles.create', compact('printings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'printing_id' => 'required|exists:printings,id',
        ]);
        PrintingStyle::create($validated);
        return redirect()->route('printing-styles.index')->with('success', 'Tạo mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintingStyle $printingStyle)
    {
        return view('printing_styles.show', compact('printingStyle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintingStyle $printingStyle)
    {
        $printings = \App\Models\Printing::all();
        return view('printing_styles.edit', [
            'printing_style' => $printingStyle,
            'printings' => $printings
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintingStyle $printingStyle)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'printing_id' => 'required|exists:printings,id',
        ]);
        $printingStyle->update($validated);
        return redirect()->route('printing-styles.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintingStyle $printingStyle)
    {
        $printingStyle->delete();
        return redirect()->route('printing-styles.index')->with('success', 'Xóa thành công!');
    }
}
