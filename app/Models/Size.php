<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'status'
    ];

    /**
     * Get the products that belong to this size.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes')
            ->withPivot('stock')
            ->withTimestamps();
    }
}
