<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    public function check()
    {
        $status = 'healthy';
        $database = 'disconnected';

        try {
            DB::connection()->getPdo();
            $database = 'connected';
        } catch (\Exception $e) {
            $database = 'error: ' . $e->getMessage();
        }

        return response()->json([
            'status' => $status,
            'message' => 'Hotel Booking API is running',
            'timestamp' => now()->toIso8601String(),
            'database' => $database,
        ], Response::HTTP_OK);
    }
}
