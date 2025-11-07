<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;

// Redirect root URL to /home if logged in, or to login otherwise
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login'); // or return view('welcome');
});

// Public landing page (openable by admins to view the site as a guest)
Route::get('/public', [HomeController::class, 'publicHome'])->name('public.home');

// Auth routes (login, register, forgot password, etc.)
Auth::routes();

// Home page after login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Protected routes (only accessible when logged in)
Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    // Hotel CRUD
    Route::resource('hotels', HotelController::class);
    // Bookings resource: restrict full CRUD to users that can manage bookings (admins/staff).
    // Regular authenticated users will use the `userbookings` view (read-only for their own bookings).
    Route::resource('bookings', App\Http\Controllers\BookingController::class)
        ->middleware('can:manage bookings');

    // Provide a simple, authenticated route for users to view their own bookings (read-only).
    Route::get('userbookings', function () {
        $bookings = auth()->user() ? auth()->user()->bookings()->latest()->get() : collect();
        return view('userbookings.index', compact('bookings'));
    })->name('userbookings.index');

    // Allow users to cancel their own bookings
    Route::patch('userbookings/{booking}/cancel', [App\Http\Controllers\BookingController::class, 'cancel'])
        ->name('userbookings.cancel');
    // Allow authenticated users to create bookings via the landing page (AJAX/post).
    // This uses the same BookingController@store but does NOT require the "manage bookings" permission.
    Route::post('userbookings', [App\Http\Controllers\BookingController::class, 'store'])
        ->name('userbookings.store');
    
    // Allow users to confirm their own bookings
    Route::patch('userbookings/{booking}/confirm', [App\Http\Controllers\BookingController::class, 'confirm'])
        ->name('userbookings.confirm');
    // Overview dashboard for admins
    Route::get('overview', [App\Http\Controllers\OverviewController::class, 'index'])->name('overview.index');
    Route::get('overview/stats', [App\Http\Controllers\OverviewController::class, 'stats'])->name('overview.stats');
});