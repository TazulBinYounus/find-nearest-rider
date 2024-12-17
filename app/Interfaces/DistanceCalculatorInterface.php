<?php

namespace App\Interfaces;

interface DistanceCalculatorInterface
{
  public function calculate($lat1, $long1, $lat2, $long2);
}
