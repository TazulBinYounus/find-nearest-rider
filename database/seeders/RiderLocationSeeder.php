<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rider;
use App\Models\RiderLocation;
use Carbon\Carbon;

class RiderLocationSeeder extends Seeder
{
    public function run()
    {
        // Get all riders from the database
        $riders = Rider::all();

        // Loop through each rider and create sample locations
        foreach ($riders as $rider) {
            // Generate random latitudes and longitudes within Dhaka's boundaries
            for ($i = 0; $i < 5; $i++) { // Create 5 random locations for each rider
                RiderLocation::create([
                    'rider_id' => $rider->id,
                    'lat' => $this->getRandomLatitude(),
                    'long' => $this->getRandomLongitude(),
                    'captured_at' => Carbon::now()->subMinutes(rand(1, 60)), // Random time within the last hour
                ]);
            }
        }
    }

    private function getRandomLatitude()
    {
        // Generate a random latitude within the range of Dhaka
        return $this->getRandomFloat(23.7267, 23.8488);
    }

    private function getRandomLongitude()
    {
        // Generate a random longitude within the range of Dhaka
        return $this->getRandomFloat(90.3505, 90.4657);
    }

    private function getRandomFloat($min, $max)
    {
        // Generate a random float between $min and $max
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }
}
