<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['name', 'location', 'phone'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'warehouse_products')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
