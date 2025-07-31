<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_gifts')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
