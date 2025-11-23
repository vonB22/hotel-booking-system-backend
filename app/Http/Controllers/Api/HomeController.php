<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HomeController extends Controller
{
    /**
     * Get featured hotels for home/landing page.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $hotels = Hotel::latest()->take(12)->get();

        return response()->json([
            'success' => true,
            'data' => $hotels,
            'message' => 'Featured hotels retrieved successfully',
        ], 200);
    }

    /**
     * Get public home data (accessible without authentication).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function publicHome()
    {
        $hotels = Hotel::latest()->take(12)->get();

        return response()->json([
            'success' => true,
            'data' => $hotels,
            'message' => 'Public home data retrieved successfully',
        ], 200);
    }
}
