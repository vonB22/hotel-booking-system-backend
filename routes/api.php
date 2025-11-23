<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HotelController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\OverviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

// Wrap all API routes with cors middleware for cross-origin requests
Route::middleware('cors')->group(function () {

    // Public Auth Routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // Public API endpoints (no authentication required)
    Route::get('/hotels', [HotelController::class, 'index']);
    Route::get('/hotels/{hotel}', [HotelController::class, 'show']);

    // Protected API endpoints (requires authentication via Sanctum)
    Route::middleware('auth:sanctum')->group(function () {
    // User endpoint
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $request->user()->id,
                'name' => $request->user()->name,
                'email' => $request->user()->email,
                'roles' => $request->user()->roles->pluck('name'),
                'permissions' => $request->user()->getAllPermissions()->pluck('name'),
            ],
        ]);
    });

    // Debug endpoint to check user roles
    Route::get('/debug/user-roles', function (Request $request) {
        $user = $request->user();
        return response()->json([
            'success' => true,
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
            'roles' => $user->roles->pluck('name')->toArray(),
            'has_admin_role' => $user->hasRole('Admin'),
            'all_roles_in_db' => \Spatie\Permission\Models\Role::pluck('name')->toArray(),
        ]);
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    // Overview/Dashboard endpoints (Admin only)
    Route::middleware('role-api:Admin')->group(function () {
        Route::get('/overview/stats', [OverviewController::class, 'stats']);
        Route::get('/overview', [OverviewController::class, 'index']);
    });

    // Role Management endpoints (Admin only)
    Route::middleware('role-api:Admin')->group(function () {
        Route::get('/roles', [RoleController::class, 'index']);
        Route::post('/roles', [RoleController::class, 'store']);
        Route::get('/roles/{role}', [RoleController::class, 'show']);
        Route::put('/roles/{role}', [RoleController::class, 'update']);
        Route::delete('/roles/{role}', [RoleController::class, 'destroy']);
    });

    // User Management endpoints (Admin only)
    Route::middleware('role-api:Admin')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users/{user}', [UserController::class, 'show']);
        Route::put('/users/{user}', [UserController::class, 'update']);
        Route::delete('/users/{user}', [UserController::class, 'destroy']);
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

});
