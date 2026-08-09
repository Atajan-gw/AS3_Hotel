<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $checkIn = fake()->dateTimeBetween('+1 day', '+30 days');
        $checkOut = (clone $checkIn)->modify(
            '+' . fake()->numberBetween(1, 14) . ' days'
        );

        $pricePerNight = fake()->randomFloat(2, 50, 500);

        $nights = $checkIn->diff($checkOut)->days;

        return [
            'room_id' => Room::factory(),
            'guest_id' => Guest::factory(),
            'check_in' => $checkIn->format('Y-m-d'),
            'check_out' => $checkOut->format('Y-m-d'),
            'guests_count' => fake()->numberBetween(1, 4),
            'price_per_night' => $pricePerNight,
            'total_price' => $pricePerNight * $nights,
            'status' => fake()->randomElement([
                'pending',
                'confirmed',
                'cancelled',
                'completed',
            ]),
            'special_requests' => fake()->optional()->sentence(),
        ];
    }
}