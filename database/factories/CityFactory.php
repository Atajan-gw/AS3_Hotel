<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CityFactory extends Factory
{
    public function definition(): array
    {
        $city = fake()->city();

        return [
            'name' => $city,
            'country' => fake()->country(),
            'slug' => Str::slug($city) . '-' . fake()->unique()->numberBetween(1, 9999),
        ];
    }
}