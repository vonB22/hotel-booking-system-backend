<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if (method_exists($user, 'hasRole') && $user->hasRole('Admin')) {
            $bookings = Booking::with(['user','product'])->latest()->paginate(10);
        } else {
            $bookings = Booking::with('product')->where('user_id', $user->id)->latest()->paginate(10);
        }

        return view('bookings.index', compact('bookings'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    public function create()
    {
    $hotels = Hotel::pluck('name','id');
    return view('bookings.create', compact('hotels'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_id' => 'nullable|exists:products,id',
            'product_name' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $data = $request->only(['product_id','check_in','check_out','guests','notes']);

        // If product_id not provided but product_name is, create or find the product
        if (empty($data['product_id']) && $request->filled('product_name')) {
            $hotel = Hotel::firstOrCreate([
                'name' => $request->input('product_name')
            ], [
                'detail' => 'Imported from landing page booking'
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

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'redirect' => route('userbookings.index')
            ], 201);
        }

        // For normal (non-AJAX) requests, redirect regular users to their bookings page.
        return redirect()->route('userbookings.index')->with('success', 'Booking created successfully');
    }

    public function show($id)
    {
        $booking = Booking::with(['user','product'])->findOrFail($id);
        $this->authorizeView($booking);
        return view('bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorizeView($booking);
    $hotels = Hotel::pluck('name','id');
    return view('bookings.edit', compact('booking','hotels'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorizeView($booking);

        $this->validate($request, [
            'product_id' => 'nullable|exists:products,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $booking->update($request->only(['product_id','check_in','check_out','guests','notes','status']));

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $this->authorizeView($booking);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully');
    }

    protected function authorizeView(Booking $booking)
    {
        $user = Auth::user();
        if (method_exists($user, 'hasRole') && $user->hasRole('Admin')) return true;
        if ($booking->user_id === $user->id) return true;
        abort(403);
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if the booking is already cancelled
        if ($booking->status === 'cancelled') {
            return redirect()->route('userbookings.index')
                ->with('error', 'Booking is already cancelled');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('userbookings.index')
            ->with('status', 'Booking has been cancelled successfully');
    }

    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Check if the booking belongs to the authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Check if the booking is in a state that can be confirmed
        if ($booking->status !== 'pending') {
            return redirect()->route('userbookings.index')
                ->with('error', 'Only pending bookings can be confirmed');
        }

        $booking->update(['status' => 'confirmed']);

        return redirect()->route('userbookings.index')
            ->with('status', 'Booking has been confirmed successfully');
    }
}
