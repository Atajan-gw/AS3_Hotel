<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\City;
use App\Models\Guest;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CitySeeder::class);
        $cities = City::all();

        foreach ($cities as $city) {
            $hotels = Hotel::factory(10)
                ->for($city)
                ->create();

            foreach ($hotels as $hotel) {
                Room::factory(100)
                    ->for($hotel)
                    ->create();
            }
        }

        Guest::factory(100)->create();

        Booking::factory(100)->create();
    }
}