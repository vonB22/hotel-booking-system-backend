<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class HealthController extends Controller
{
    public function check()
    {
        return response()->json([
            'status' => 'healthy',
            'message' => 'Hotel Booking API is running',
            'timestamp' => now()->toIso8601String(),
        ], Response::HTTP_OK);
    }
}
