<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRiderLocationRequest;
use App\Models\RiderLocation;
use App\Services\RiderService;

class RiderController extends Controller
{
    protected $riderService;

    public function __construct(RiderService $riderService)
    {
        $this->riderService = $riderService;
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
        return $this->riderService->getNearestRider($restaurant_id);
    }
}
