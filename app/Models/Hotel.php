<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    // Keep using the existing `products` table for backward compatibility
    protected $table = 'products';

    protected $fillable = ['name', 'detail', 'price', 'location', 'image'];

    protected $casts = [
        'price' => 'decimal:2',
    ];
}
