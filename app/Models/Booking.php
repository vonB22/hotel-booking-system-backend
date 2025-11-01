<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'check_in',
        'check_out',
        'guests',
        'notes',
        'status',
        'total_price'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        // The bookings table still uses `product_id` as the FK. Return the Hotel model instance.
        return $this->belongsTo(Hotel::class, 'product_id');
    }

    public function hotel(): BelongsTo
    {
        // alias helper if code expects hotel() relation
        return $this->belongsTo(Hotel::class, 'product_id');
    }
}
