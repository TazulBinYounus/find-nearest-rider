<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRiderLocationRequest;
use App\Models\Restaurant;
use App\Models\RiderLocation;
use App\Services\DistanceCalculator; // Import the DistanceCalculator service
use Illuminate\Support\Facades\Cache;

class RiderController extends Controller
{
    protected $distanceCalculator;

    public function __construct(DistanceCalculator $distanceCalculator)
    {
        $this->distanceCalculator = $distanceCalculator;
    }

    public function storeRiderLocation(StoreRiderLocationRequest $request)
    {
        // Create the rider location record
        $riderLocation = RiderLocation::create([
            'rider_id' => $request->input('rider_id'),
            'lat' => $request->input('lat'),
            'long' => $request->input('long'),
            'captured_at' => $request->input('captured_at'),
        ]);

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Rider location stored successfully.',
            'data' => $riderLocation,
        ], 201);
    }

    public function getNearestRider($restaurant_id)
    {
        // Define a cache key
        $cacheKey = 'nearest_rider_' . $restaurant_id;

        // Attempt to retrieve the nearest rider from the cache
        $nearestRiderData = Cache::get($cacheKey);

        // If not found in cache, perform the database query
        if (!$nearestRiderData) {
            // Retrieve the restaurant's latitude and longitude
            $restaurant = Restaurant::find($restaurant_id);
            if (!$restaurant) {
                return response()->json(['success' => false, 'message' => 'Restaurant not found.'], 404);
            }

            $restaurantLat = $restaurant->lat;
            $restaurantLong = $restaurant->long;

            // Fetch all riders' locations
            $riders = RiderLocation::with('rider')->get();

            $nearestRider = null;
            $shortestDistance = PHP_INT_MAX;

            foreach ($riders as $rider) {
                // Calculate distance using the DistanceCalculator service
                $distance = $this->distanceCalculator->haversineGreatCircleDistance(
                    $restaurantLat,
                    $restaurantLong,
                    $rider->lat,
                    $rider->long
                );

                if ($distance < $shortestDistance) {
                    $shortestDistance = $distance;
                    $nearestRider = $rider;
                }
            }

            if ($nearestRider) {
                // Cache the nearest rider result for 5 minutes (300 seconds)
                Cache::put($cacheKey, [
                    'rider' => $nearestRider,
                    'distance' => $shortestDistance,
                ], 300);
            } else {
                return response()->json(['success' => false, 'message' => 'No riders found.'], 404);
            }
        } else {
            // If found in cache, prepare the response
            $nearestRider = $nearestRiderData['rider'];
            $shortestDistance = $nearestRiderData['distance'];
        }

        return response()->json([
            'success' => true,
            'nearest_rider' => $nearestRider,
            'distance' => $shortestDistance,
        ], 200);
    }
}
