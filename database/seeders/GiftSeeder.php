<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gift;

class GiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gifts = [
            [
                'name' => 'Túi xách thể thao',
                'price' => 150000,
                'description' => 'Túi xách thể thao cao cấp, phù hợp cho việc tập luyện và du lịch',
                'status' => 'active'
            ],
            [
                'name' => 'Vớ thể thao',
                'price' => 50000,
                'description' => 'Vớ thể thao chất liệu cotton thoáng mát, co giãn tốt',
                'status' => 'active'
            ],
            [
                'name' => 'Bóng tập mini',
                'price' => 80000,
                'description' => 'Bóng tập mini cao su, kích thước vừa phải cho các bài tập',
                'status' => 'active'
            ],
            [
                'name' => 'Khăn thể thao',
                'price' => 30000,
                'description' => 'Khăn thể thao microfiber, thấm hút tốt, khô nhanh',
                'status' => 'active'
            ],
            [
                'name' => 'Bình nước thể thao',
                'price' => 120000,
                'description' => 'Bình nước thể thao 500ml, giữ nhiệt tốt',
                'status' => 'active'
            ]
        ];

        foreach ($gifts as $gift) {
            Gift::create($gift);
        }
    }
} 