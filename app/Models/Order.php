<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'order_code',
        'status',
        'total_amount',
        'deposit',
        'note'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    /**
     * Get the customer that owns the order.
     */
    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class);
    }

    /**
     * Get the order items for this order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the products for this order through order items.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
                    ->withPivot('quantity', 'price', 'total')
                    ->withTimestamps();
    }

    /**
     * Generate a unique order code.
     */
    public static function generateOrderCode()
    {
        $prefix = 'ORD';
        $date = now()->format('Ymd');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        return $prefix . $date . $random;
    }

    /**
     * Calculate total amount from order items.
     */
    public function calculateTotal()
    {
        $total = $this->orderItems->sum('total');
        $this->update(['total_amount' => $total]);
        return $total;
    }

    /**
     * Get status label.
     */
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending' => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
            default => 'Không xác định'
        };
    }
}
