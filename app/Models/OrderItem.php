<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'total'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Get the order that owns the order item.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that owns the order item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the printing styles for this order item.
     */
    public function printingStyles()
    {
        return $this->belongsToMany(\App\Models\PrintingStyle::class, 'order_item_printing_style')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Calculate total for this order item.
     */
    public function calculateTotal()
    {
        $this->total = $this->price * $this->quantity;
        $this->save();
        return $this->total;
    }

    /**
     * Boot method to automatically calculate total when saving.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($orderItem) {
            if ($orderItem->price && $orderItem->quantity) {
                $orderItem->total = $orderItem->price * $orderItem->quantity;
            }
        });

        static::saved(function ($orderItem) {
            // Recalculate order total when order item is saved
            if ($orderItem->order) {
                $orderItem->order->calculateTotal();
            }
        });

        static::deleted(function ($orderItem) {
            // Recalculate order total when order item is deleted
            if ($orderItem->order) {
                $orderItem->order->calculateTotal();
            }
        });
    }
}
