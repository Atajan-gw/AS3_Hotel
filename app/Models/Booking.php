<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Room;
use App\Models\Guest;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'guest_id',
        'check_in',
        'check_out',
        'guests_count',
        'price_per_night',
        'total_price',
        'status',
        'special_requests',
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'guests_count' => 'integer',
        'price_per_night' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(Guest::class);
    }

    public function getDisplayStatusAttribute(): string
    {
        $status = strtolower((string) $this->status);

        if (in_array($status, ['cancelled', 'canceled'], true)) {
            return __('app.canceled');
        }

        $today = now()->toDateString();
        $checkIn = $this->check_in?->toDateString();
        $checkOut = $this->check_out?->toDateString();

        if ($checkIn && $today < $checkIn) {
            return __('app.pending');
        }

        if ($checkIn && $checkOut && $today >= $checkIn && $today < $checkOut) {
            return __('app.confirmed');
        }

        if ($checkOut && $today >= $checkOut) {
            return __('app.completed');
        }

        return __('app.pending');
    }
}