<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'hotel_id' => Hotel::factory(),
            'number' => (string) fake()->numberBetween(100, 999),
            'type' => fake()->randomElement(['single', 'double', 'twin', 'family', 'suite',]),
            'description' => fake()->optional()->sentence(),
            'capacity' => fake()->numberBetween(1, 5),
            'price_per_night' => fake()->randomFloat(2, 500, 1500),
            'is_available' => fake()->boolean(50),
        ];
    }
}
