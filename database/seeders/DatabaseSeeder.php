<?php

namespace Database\Seeders;

use App\Models\RiderLocation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RiderSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(RiderLocationSeeder::class);
    }
}
