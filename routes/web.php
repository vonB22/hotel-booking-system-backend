<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;

// Root route - show welcome page
Route::get('/', function () {
    return view('welcome');
});

// Public landing page (openable by admins to view the site as a guest)
Route::get('/public', [HomeController::class, 'publicHome'])->name('public.home');

// Auth routes (login, register, forgot password, etc.)
Auth::routes();

// Admin dashboard routes - grouped under /admin prefix
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Admin resources
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('hotels', HotelController::class);
    Route::resource('bookings', App\Http\Controllers\BookingController::class)
        ->middleware('can:manage bookings');

    // Overview dashboard for admins
    Route::get('overview', [App\Http\Controllers\OverviewController::class, 'index'])->name('overview.index');
    Route::get('overview/stats', [App\Http\Controllers\OverviewController::class, 'stats'])->name('overview.stats');
});

// User bookings routes - separate from admin
Route::middleware(['auth'])->group(function () {
    // User bookings (read-only for their own bookings)
    Route::get('userbookings', function () {
        $bookings = auth()->user() ? auth()->user()->bookings()->latest()->get() : collect();
        return view('userbookings.index', compact('bookings'));
    })->name('userbookings.index');

    // Allow users to cancel their own bookings
    Route::patch('userbookings/{booking}/cancel', [App\Http\Controllers\BookingController::class, 'cancel'])
        ->name('userbookings.cancel');
    
    // Allow authenticated users to create bookings
    Route::post('userbookings', [App\Http\Controllers\BookingController::class, 'store'])
        ->name('userbookings.store');
    
    // Allow users to confirm their own bookings
    Route::patch('userbookings/{booking}/confirm', [App\Http\Controllers\BookingController::class, 'confirm'])
        ->name('userbookings.confirm');
});