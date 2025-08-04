<?php

namespace App\Http\Controllers\Client;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // Validate email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Here you can add logic to save email to database or send to email service
            // For now, we'll just show a success message
            
            // Example: Save to database (uncomment if you have a newsletter table)
            // Newsletter::create([
            //     'email' => $request->email,
            //     'status' => 'active'
            // ]);
            
            return back()->with('newsletter_success', 'Cảm ơn bạn đã đăng ký nhận tin! Chúng tôi sẽ gửi thông tin mới nhất đến email của bạn.');
            
        } catch (\Exception $e) {
            return back()->with('newsletter_error', 'Có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    }
} 