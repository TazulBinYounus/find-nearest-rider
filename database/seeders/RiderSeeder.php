<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RiderSeeder extends Seeder
{
    public function run(): void
    {
        $riders = [];

        // Sample service names for different riders
        $serviceNames = [
            'Food Delivery',
            'Parcel Delivery',
            'Grocery Delivery',
            'Medicine Delivery',
            'Courier Service',
            'Flower Delivery',
            'Document Delivery',
            'Laundry Delivery',
            'Pet Supplies Delivery',
            'Electronics Delivery',
        ];

        foreach ($serviceNames as $index => $serviceName) {
            $name = 'Rider ' . ($index + 1);
            $riders[] = [
                'name' => $name,
                'service_name' => $serviceName,
                'timestamp' => Carbon::now()->addDays($index + 1)->format('Y-m-d H:i:s'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('riders')->insert($riders);
    }
}
