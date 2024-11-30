<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiderController;

Route::post('/rider-locations', [RiderController::class, 'storeRiderLocation']);
Route::middleware('throttle:60,1')->get('/nearest-rider/{restaurant_id}', [RiderController::class, 'getNearestRider']);
