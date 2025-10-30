<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Product;
use Spatie\Permission\Models\Role;

class OverviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }

    public function index()
    {
        return view('overview.index');
    }

    public function stats(Request $request)
    {
        $users = User::count();
        $products = Product::count();
        $roles = Role::count();
        $bookings = Booking::count();
        $bookings_pending = Booking::where('status', 'pending')->count();

        return response()->json([
            'users' => $users,
            'products' => $products,
            'roles' => $roles,
            'bookings' => $bookings,
            'bookings_pending' => $bookings_pending,
        ]);
    }
}
