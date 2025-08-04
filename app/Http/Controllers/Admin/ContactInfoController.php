<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    /**
     * Hiển thị form chỉnh sửa thông tin liên hệ
     */
    public function edit()
    {
        $contactInfo = Setting::getContactInfo();
        
        return view('admin.contact_info.edit', compact('contactInfo'));
    }

    /**
     * Cập nhật thông tin liên hệ
     */
    public function update(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'shop_address' => 'required|string|max:500',
            'shop_phone' => 'required|string|max:20',
            'shop_email' => 'required|email|max:255',
            'shop_website' => 'nullable|url|max:255',
            'shop_facebook' => 'nullable|url|max:255',
            'shop_instagram' => 'nullable|url|max:255',
            'shop_working_hours' => 'required|string|max:255',
            'shop_description' => 'required|string|max:1000',
        ]);

        $fields = [
            'shop_name',
            'shop_address',
            'shop_phone',
            'shop_email',
            'shop_website',
            'shop_facebook',
            'shop_instagram',
            'shop_working_hours',
            'shop_description',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                Setting::setValue($field, $request->input($field));
            }
        }

        return redirect()->route('admin.contact-info.edit')
            ->with('success', 'Thông tin liên hệ đã được cập nhật thành công!');
    }
}
