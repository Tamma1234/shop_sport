<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'sku', 'description', 'category_id', 'tags', 'price', 'discount_price', 'stock', 'weight', 'dimensions', 'image', 'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
