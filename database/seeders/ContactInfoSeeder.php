<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
                'value' => 'https://www.facebook.com/JRSPORTS.FANPAGE/',
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
            DB::table('settings')->updateOrInsert(
                ['key' => $info['key']],
                $info
            );
        }
    }
}
