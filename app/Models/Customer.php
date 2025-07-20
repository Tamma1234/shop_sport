<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'note'
    ];

    /**
     * Get the orders for this customer.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the customer's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    /**
     * Get the customer's contact information.
     */
    public function getContactInfoAttribute()
    {
        $info = [];
        if ($this->phone) {
            $info[] = $this->phone;
        }
        if ($this->email) {
            $info[] = $this->email;
        }
        return implode(' | ', $info);
    }
} 