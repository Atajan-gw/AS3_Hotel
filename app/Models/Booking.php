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

    public static function resolveStatusFromDates(?string $checkIn, ?string $checkOut): string
    {
        $today = now()->toDateString();
        $checkInDate = $checkIn ? now()->parse($checkIn)->toDateString() : null;
        $checkOutDate = $checkOut ? now()->parse($checkOut)->toDateString() : null;

        if ($checkInDate && $today < $checkInDate) {
            return 'pending';
        }

        if ($checkInDate && $checkOutDate && $today >= $checkInDate && $today < $checkOutDate) {
            return 'confirmed';
        }

        if ($checkOutDate && $today >= $checkOutDate) {
            return 'completed';
        }

        return 'pending';
    }

    public function getDisplayStatusAttribute(): string
    {
        $status = strtolower((string) $this->status);

        if (in_array($status, ['cancelled', 'canceled'], true)) {
            return __('app.cancelled');
        }

        $resolvedStatus = self::resolveStatusFromDates(
            $this->check_in?->toDateString(),
            $this->check_out?->toDateString()
        );

        return match ($resolvedStatus) {
            'confirmed' => __('app.confirmed'),
            'completed' => __('app.completed'),
            default => __('app.pending'),
        };
    }
}