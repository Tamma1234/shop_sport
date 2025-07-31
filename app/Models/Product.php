<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name', 'slug', 'sku', 'description', 'category_id', 'warehouse_id', 'tags', 'price', 'discount_price', 'price_warehouse', 'stock', 'weight', 'dimensions', 'image', 'status'
    ];

    protected $casts = [
        'tags' => 'array',
        'status' => 'string'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
