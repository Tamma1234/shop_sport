<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = \App\Models\Category::pluck('id')->toArray();
        if (empty($categoryIds)) {
            // Nếu chưa có category, tạo 3 category mẫu
            $categoryIds = \App\Models\Category::factory(3)->create()->pluck('id')->toArray();
        }

        \App\Models\Product::factory(10)->make()->each(function ($product) use ($categoryIds) {
            $product->category_id = $categoryIds[array_rand($categoryIds)];
            $product->save();
        });
    }
}
