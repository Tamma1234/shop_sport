<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(5)->create()->each(function (Category $category): void {
            \App\Models\Product::factory(rand(2,4))->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
