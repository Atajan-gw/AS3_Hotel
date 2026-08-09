<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Hotel;
use App\Models\Booking;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'number',
        'type',
        'description',
        'capacity',
        'price_per_night',
        'is_available',
    ];

    protected $casts = [
        'capacity' => 'integer',
        'price_per_night' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
