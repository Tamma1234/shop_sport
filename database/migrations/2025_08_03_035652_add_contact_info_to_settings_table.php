<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Thêm các bản ghi thông tin liên hệ vào bảng settings
        $contactInfo = [
            [
                'key' => 'shop_name',
                'value' => 'Shop Sport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'shop_address',
                'value' => '123 Đường ABC, Quận XYZ, TP.HCM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'shop_phone',
                'value' => '0123 456 789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'shop_email',
                'value' => 'info@shopsport.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'shop_website',
                'value' => 'https://shopsport.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'shop_facebook',
                'value' => 'https://facebook.com/shopsport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'shop_instagram',
                'value' => 'https://instagram.com/shopsport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'shop_working_hours',
                'value' => 'Thứ 2 - Chủ nhật: 8:00 - 22:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'shop_description',
                'value' => 'Chuyên cung cấp các sản phẩm thể thao chất lượng cao với giá cả hợp lý',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($contactInfo as $info) {
            DB::table('settings')->insertOrIgnore($info);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa các bản ghi thông tin liên hệ
        $keysToDelete = [
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

        DB::table('settings')->whereIn('key', $keysToDelete)->delete();
    }
};
