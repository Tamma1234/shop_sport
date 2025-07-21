<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Printing extends Model
{
    use HasFactory;
    protected $table = 'printings';
    protected $fillable = ['name', 'description'];

    public function printingStyles()
    {
        return $this->hasMany(PrintingStyle::class);
    }

    public function styles()
    {
        return $this->printingStyles();
    }
}
