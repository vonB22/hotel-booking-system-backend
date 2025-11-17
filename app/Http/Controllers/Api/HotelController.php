<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->middleware('permission:hotel-list|hotel-create|hotel-edit|hotel-delete', ['only' => ['index', 'show']])->except(['index', 'show']);
        $this->middleware('permission:hotel-create', ['only' => ['store']]);
        $this->middleware('permission:hotel-edit', ['only' => ['update']]);
        $this->middleware('permission:hotel-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of hotels.
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->input('per_page', 15);
            $hotels = Hotel::paginate($perPage);
            
            return response()->json([
                'success' => true,
                'message' => 'Hotels retrieved successfully',
                'data' => $hotels->items(),
                'pagination' => [
                    'current_page' => $hotels->currentPage(),
                    'per_page' => $hotels->perPage(),
                    'total' => $hotels->total(),
                    'last_page' => $hotels->lastPage(),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve hotels',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created hotel.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'detail' => 'required|string',
                'price' => 'nullable|numeric|min:0',
                'location' => 'nullable|string|max:255',
                'rating' => 'nullable|integer|min:0|max:5',
                'rooms' => 'nullable|integer|min:0',
                'amenities' => 'nullable|array',
            ]);

            if (isset($validated['amenities']) && is_array($validated['amenities'])) {
                $validated['amenities'] = implode(',', $validated['amenities']);
            }

            $hotel = Hotel::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Hotel created successfully',
                'data' => $hotel
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
                'message' => 'Failed to create hotel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified hotel.
     */
    public function show(Hotel $hotel): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Hotel retrieved successfully',
                'data' => $hotel
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve hotel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified hotel.
     */
    public function update(Request $request, Hotel $hotel): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'detail' => 'required|string',
                'price' => 'nullable|numeric|min:0',
                'location' => 'nullable|string|max:255',
                'rating' => 'nullable|integer|min:0|max:5',
                'rooms' => 'nullable|integer|min:0',
                'amenities' => 'nullable|array',
            ]);

            if (isset($validated['amenities']) && is_array($validated['amenities'])) {
                $validated['amenities'] = implode(',', $validated['amenities']);
            }

            $hotel->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Hotel updated successfully',
                'data' => $hotel
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update hotel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified hotel.
     */
    public function destroy(Hotel $hotel): JsonResponse
    {
        try {
            $hotel->delete();

            return response()->json([
                'success' => true,
                'message' => 'Hotel deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete hotel',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
