<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gift;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;

class GiftController extends Controller
{
    /**
     * Display a listing of the gifts.
     */
    public function index()
    {
        $gifts = Gift::latest()->paginate(10);
        return view('admin.gifts.index', compact('gifts'));
    }

    /**
     * Show the form for creating a new gift.
     */
    public function create()
    {
        return view('admin.gifts.create');
    }

    /**
     * Store a newly created gift in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Gift::create($request->all());

        return redirect()
            ->route('gifts.index')
            ->with('success', 'Quà tặng đã được tạo thành công.');
    }

    /**
     * Show the form for editing the specified gift.
     */
    public function edit(Gift $gift)
    {
        return view('admin.gifts.edit', compact('gift'));
    }

    /**
     * Update the specified gift in storage.
     */
    public function update(Request $request, Gift $gift)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $gift->update($request->all());

        return redirect()
            ->route('gifts.index')
            ->with('success', 'Quà tặng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified gift from storage.
     */
    public function destroy(Gift $gift)
    {
        $gift->delete();

        return redirect()
            ->route('gifts.index')
            ->with('success', 'Quà tặng đã được xóa thành công.');
    }
}
