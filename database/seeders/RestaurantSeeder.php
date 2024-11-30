<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    public function run()
    {
        // Sample restaurant data
        $restaurants = [
            [
                'name' => 'Pizza Place',
                'lat' => 34.052235,
                'long' => -118.243683,
            ],
            [
                'name' => 'Burger Joint',
                'lat' => 34.052235,
                'long' => -118.243700,
            ],
            [
                'name' => 'Sushi Spot',
                'lat' => 34.052240,
                'long' => -118.243650,
            ],
            [
                'name' => 'Taco Stand',
                'lat' => 34.052230,
                'long' => -118.243680,
            ],
            [
                'name' => 'Steakhouse',
                'lat' => 34.052250,
                'long' => -118.243690,
            ],
        ];

        // Insert data into the restaurants table
        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}
