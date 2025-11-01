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
    Route::resource('bookings', App\Http\Controllers\BookingController::class);
    // Overview dashboard for admins
    Route::get('overview', [App\Http\Controllers\OverviewController::class, 'index'])->name('overview.index');
    Route::get('overview/stats', [App\Http\Controllers\OverviewController::class, 'stats'])->name('overview.stats');
});