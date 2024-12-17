<?php

namespace App\Services\Calculators;

use App\Interfaces\DistanceCalculatorInterface;

class HaversineDistanceCalculator implements DistanceCalculatorInterface
{
  public function calculate($lat1, $long1, $lat2, $long2)
  {
    $earthRadius = 6371; // Earth's radius in km
    return $earthRadius * acos(
      cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        cos(deg2rad($long2) - deg2rad($long1)) +
        sin(deg2rad($lat1)) * sin(deg2rad($lat2))
    );
  }
}
