<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Hotel;
use Spatie\Permission\Models\Role;

class OverviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('role-api:Admin');
    }

    /**
     * Get dashboard overview information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'message' => 'Admin dashboard overview',
                'user' => auth()->user(),
            ],
            'message' => 'Dashboard overview retrieved successfully',
        ], 200);
    }

    /**
     * Get dashboard statistics.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function stats(Request $request)
    {
        $users = User::count();
        $hotels = Hotel::count();
        $roles = Role::count();
        $bookings = Booking::count();
        $bookings_pending = Booking::where('status', 'pending')->count();

        // Get booking status distribution
        $booking_status = [
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
        ];

        // Get monthly bookings for the last 12 months
        $monthly_bookings = [];
        $now = now();
        for ($i = 11; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $count = Booking::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            $monthly_bookings[] = $count;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'users' => $users,
                'hotels' => $hotels,
                'roles' => $roles,
                'bookings' => $bookings,
                'bookings_pending' => $bookings_pending,
                'booking_status' => $booking_status,
                'monthly_bookings' => $monthly_bookings,
            ],
            'message' => 'Dashboard statistics retrieved successfully',
        ], 200);
    }
}
