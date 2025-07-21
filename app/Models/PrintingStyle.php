<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrintingStyle extends Model
{
    use HasFactory;

    protected $table = 'printing_styles';
    protected $fillable = ['printing_id', 'name', 'price'];

    public function printing()
    {
        return $this->belongsTo(Printing::class);
    }

    public function orders()
    {
        return $this->belongsToMany(\App\Models\Order::class, 'order_printing_style');
    }
}
