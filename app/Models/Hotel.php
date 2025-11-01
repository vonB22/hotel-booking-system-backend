<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    // Keep using the existing `products` table for backward compatibility
    protected $table = 'products';

    protected $fillable = ['name', 'detail', 'price', 'location', 'image', 'rating', 'rooms', 'amenities'];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'integer',
    ];

    /**
     * Ensure rating is always an integer between 0 and 5 when accessed.
     */
    public function getRatingAttribute($value)
    {
        $r = intval($value ?? 0);
        if ($r < 0) $r = 0;
        if ($r > 5) $r = 5;
        return $r;
    }
}
