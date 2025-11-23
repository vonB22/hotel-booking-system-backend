<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Support\Facades\DB;

class OverviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin');
    }

    /**
     * Display dashboard overview page
     * GET /overview
     */
    public function index(Request $request)
    {
        try {
            $recentBookings = Booking::select(
                'bookings.id',
                'users.name as user_name',
                'products.name as hotel_name',
                'bookings.check_in',
                'bookings.status'
            )
            ->join('users', 'bookings.user_id', '=', 'users.id')
            ->join('products', 'bookings.product_id', '=', 'products.id')
            ->orderBy('bookings.created_at', 'desc')
            ->limit(10)
            ->get();

            $totalBookings = Booking::count();
            $totalHotels = Hotel::count();
            $totalUsers = User::count();
            
            $totalRevenue = Booking::where('status', 'confirmed')
                ->sum('total_price');

            return view('overview.index', [
                'recentBookings' => $recentBookings,
                'totalBookings' => $totalBookings,
                'totalHotels' => $totalHotels,
                'totalUsers' => $totalUsers,
                'totalRevenue' => floatval($totalRevenue ?? 0),
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve overview data: ' . $e->getMessage());
        }
    }

    /**
     * Get dashboard statistics via AJAX
     * GET /overview/stats
     */
    public function stats(Request $request)
    {
        try {
            $totalBookings = Booking::count();
            $totalHotels = Hotel::count();
            $totalUsers = User::count();
            
            $bookingsPending = Booking::where('status', 'pending')->count();
            
            $totalRevenue = Booking::where('status', 'confirmed')
                ->sum('total_price');

            // Get roles count
            $rolesCount = \Spatie\Permission\Models\Role::count();

            // Booking status distribution
            $bookingStatus = Booking::select('status')
                ->selectRaw('count(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            // Monthly bookings data for the past 12 months
            $monthlyBookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', now()->year)
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();

            // Ensure all 12 months are represented
            $monthlyData = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthlyData[] = intval($monthlyBookings[$i] ?? 0);
            }

            return response()->json([
                'users' => intval($totalUsers),
                'hotels' => intval($totalHotels),
                'bookings' => intval($totalBookings),
                'bookings_pending' => intval($bookingsPending),
                'roles' => intval($rolesCount),
                'revenue' => floatval($totalRevenue ?? 0),
                'booking_status' => array_map('intval', $bookingStatus),
                'monthly_bookings' => $monthlyData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve statistics',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
