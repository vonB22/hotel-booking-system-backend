<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of bookings.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $perPage = $request->input('per_page', 15);

            if (method_exists($user, 'hasRole') && $user->hasRole('Admin')) {
                $bookings = Booking::with(['user', 'product'])->latest()->paginate($perPage);
            } else {
                $bookings = Booking::where('user_id', $user->id)->with('product')->latest()->paginate($perPage);
            }

            return response()->json([
                'success' => true,
                'message' => 'Bookings retrieved successfully',
                'data' => $bookings->items(),
                'pagination' => [
                    'current_page' => $bookings->currentPage(),
                    'per_page' => $bookings->perPage(),
                    'total' => $bookings->total(),
                    'last_page' => $bookings->lastPage(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve bookings',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created booking.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'product_id' => 'nullable|exists:products,id',
                'product_name' => 'nullable|string|max:255',
                'price' => 'nullable|numeric|min:0',
                'check_in' => 'required|date',
                'check_out' => 'required|date|after:check_in',
                'guests' => 'required|integer|min:1',
                'notes' => 'nullable|string',
            ]);

            $data = $request->only(['product_id', 'check_in', 'check_out', 'guests', 'notes']);

            // If product_id not provided but product_name is, create or find the product
            if (empty($data['product_id']) && $request->filled('product_name')) {
                $hotel = Hotel::firstOrCreate([
                    'name' => $request->input('product_name')
                ], [
                    'detail' => 'Imported from API booking'
                ]);
                $data['product_id'] = $hotel->id;
            }

            // Compute total price when price provided and dates available
            if ($request->filled('price') && $request->filled('check_in') && $request->filled('check_out')) {
                try {
                    $checkIn = \Carbon\Carbon::parse($request->input('check_in'));
                    $checkOut = \Carbon\Carbon::parse($request->input('check_out'));
                    $nights = max(1, $checkOut->diffInDays($checkIn));
                    $data['total_price'] = $nights * floatval($request->input('price'));
                } catch (\Exception $e) {}
            }

            $data['user_id'] = Auth::id();
            $booking = Booking::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully',
                'data' => $booking
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified booking.
     */
    public function show($id): JsonResponse
    {
        try {
            $booking = Booking::with(['user', 'product'])->findOrFail($id);
            $this->authorizeView($booking);

            return response()->json([
                'success' => true,
                'message' => 'Booking retrieved successfully',
                'data' => $booking
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified booking.
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);
            $this->authorizeView($booking);

            $validated = $request->validate([
                'product_id' => 'nullable|exists:products,id',
                'check_in' => 'required|date',
                'check_out' => 'required|date|after:check_in',
                'guests' => 'required|integer|min:1',
                'notes' => 'nullable|string',
                'status' => 'nullable|string|in:pending,confirmed,cancelled',
            ]);

            $booking->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Booking updated successfully',
                'data' => $booking
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified booking.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);
            $this->authorizeView($booking);
            $booking->delete();

            return response()->json([
                'success' => true,
                'message' => 'Booking deleted successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel a booking.
     */
    public function cancel($id): JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);

            if ($booking->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            if ($booking->status === 'cancelled') {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking is already cancelled'
                ], 400);
            }

            $booking->update(['status' => 'cancelled']);

            return response()->json([
                'success' => true,
                'message' => 'Booking has been cancelled successfully',
                'data' => $booking
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Confirm a booking.
     */
    public function confirm($id): JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);

            if ($booking->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            if ($booking->status !== 'pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Only pending bookings can be confirmed'
                ], 400);
            }

            $booking->update(['status' => 'confirmed']);

            return response()->json([
                'success' => true,
                'message' => 'Booking has been confirmed successfully',
                'data' => $booking
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to confirm booking',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    protected function authorizeView(Booking $booking)
    {
        $user = Auth::user();
        if (method_exists($user, 'hasRole') && $user->hasRole('Admin')) return true;
        if ($booking->user_id === $user->id) return true;
        abort(403);
    }
}
