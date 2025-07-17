<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 10, 500),
            'discount_price' => $this->faker->optional(0.5)->randomFloat(2, 5, 400),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => $this->faker->imageUrl(400, 400, 'sports', true, 'product'),
        ];
    }
}
