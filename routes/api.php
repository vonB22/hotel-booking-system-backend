<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

// Public API endpoints (no authentication required)
Route::get('/hotels', [HotelController::class, 'index']);
Route::get('/hotels/{hotel}', [HotelController::class, 'show']);

// Protected API endpoints (requires authentication via Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    // User endpoint
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    });

    // Hotel management endpoints
    Route::post('/hotels', [HotelController::class, 'store']);
    Route::put('/hotels/{hotel}', [HotelController::class, 'update']);
    Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy']);

    // Booking endpoints
    Route::get('/bookings', [BookingController::class, 'index']);
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/bookings/{booking}', [BookingController::class, 'show']);
    Route::put('/bookings/{booking}', [BookingController::class, 'update']);
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy']);
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel']);
    Route::patch('/bookings/{booking}/confirm', [BookingController::class, 'confirm']);
});
