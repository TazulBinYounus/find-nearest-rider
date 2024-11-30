<?php

namespace App\Services;

class DistanceCalculator
{
  public function haversineGreatCircleDistance($latFrom, $lonFrom, $latTo, $lonTo, $earthRadius = 6371)
  {
    // Convert from degrees to radians
    $latFrom = deg2rad($latFrom);
    $lonFrom = deg2rad($lonFrom);
    $latTo = deg2rad($latTo);
    $lonTo = deg2rad($lonTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    // Haversine formula
    $a = sin($latDelta / 2) * sin($latDelta / 2) +
      cos($latFrom) * cos($latTo) *
      sin($lonDelta / 2) * sin($lonDelta / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $earthRadius * $c; // Distance in kilometers
  }
}
