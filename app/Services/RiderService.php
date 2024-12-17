<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Models\RiderLocation;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\DistanceCalculatorInterface;





class RiderService
{
  protected $distanceCalculator;

  public function __construct(DistanceCalculatorInterface $distanceCalculator)
  {
    $this->distanceCalculator = $distanceCalculator;
  }

  public function getNearestRider($restaurant_id)
  {
    $cacheKey = 'nearest_rider_' . $restaurant_id;

    // Check if data exists in cache
    $cachedData = $this->getCachedNearestRider($cacheKey);
    if ($cachedData) {
      return $this->successResponse($cachedData);
    }

    // Fetch restaurant details
    $restaurant = $this->getRestaurant($restaurant_id);
    if (!$restaurant) {
      return $this->errorResponse('Restaurant not found.', 404);
    }

    // Calculate nearest rider
    $nearestRider = $this->calculateNearestRider($restaurant);
    if (!$nearestRider) {
      return $this->errorResponse('No riders found.', 404);
    }

    // Cache and return the response
    $this->cacheNearestRider($cacheKey, $nearestRider);
    return $this->successResponse($nearestRider);
  }

  private function getRestaurant($restaurant_id)
  {
    return Restaurant::find($restaurant_id);
  }

  private function getCachedNearestRider($cacheKey)
  {
    return Cache::get($cacheKey);
  }

  private function calculateNearestRider($restaurant)
  {
    $riders = RiderLocation::with('rider')->get();
    $nearestRider = null;
    $shortestDistance = PHP_INT_MAX;

    foreach ($riders as $rider) {
      $distance = $this->distanceCalculator->calculate(
        $restaurant->lat,
        $restaurant->long,
        $rider->lat,
        $rider->long
      );

      if ($distance < $shortestDistance) {
        $shortestDistance = $distance;
        $nearestRider = [
          'rider' => $rider,
          'distance' => $distance,
        ];
      }
    }

    return $nearestRider;
  }

  private function cacheNearestRider($cacheKey, $data)
  {
    Cache::put($cacheKey, $data, 300); // Cache for 5 minutes
  }

  private function successResponse($data)
  {
    return response()->json([
      'success' => true,
      'nearest_rider' => $data['rider'],
      'distance' => $data['distance'],
    ], 200);
  }

  private function errorResponse($message, $code)
  {
    return response()->json([
      'success' => false,
      'message' => $message,
    ], $code);
  }
}
