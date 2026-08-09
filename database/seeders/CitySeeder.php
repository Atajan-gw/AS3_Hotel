<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            [ 'name' => 'Aşgabat', 'country' => 'Türkmenistan', 'slug' => 'ashgabat', ],
            [ 'name' => 'Türkmenabat', 'country' => 'Türkmenistan', 'slug' => 'turkmenabat', ],
            [ 'name' => 'Daşoguz', 'country' => 'Türkmenistan', 'slug' => 'dashoguz', ],
            [ 'name' => 'Mary', 'country' => 'Türkmenistan', 'slug' => 'mary', ],
            [ 'name' => 'Balkanabat', 'country' => 'Türkmenistan', 'slug' => 'balkanabat', ],
            [ 'name' => 'Türkmenbaşy', 'country' => 'Türkmenistan', 'slug' => 'turkmenbashi', ],
            [ 'name' => 'Köneürgenç', 'country' => 'Türkmenistan', 'slug' => 'konurgench', ],
            [ 'name' => 'Baýramaly', 'country' => 'Türkmenistan', 'slug' => 'bayramaly', ],
            [ 'name' => 'Gökdepe', 'country' => 'Türkmenistan', 'slug' => 'gokdepe', ],
            [ 'name' => 'Hazar', 'country' => 'Türkmenistan', 'slug' => 'hazar', ],
        ];
        foreach ($cities as $city) {
            City::updateOrCreate(
                [ 'slug' => $city['slug'] ],
                [ 
                    'name' => $city['name'],
                    'country' => $city['country']
                ]
            );
        }
    }
}