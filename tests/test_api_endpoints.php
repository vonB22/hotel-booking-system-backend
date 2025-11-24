<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Booking;

// Authenticate as admin
$user = User::find(1);
\Illuminate\Support\Facades\Auth::login($user);

// Test 1: Create a booking
echo "=== TEST 1: CREATE BOOKING ===\n";
try {
    $booking = Booking::create([
        'user_id' => 1,
        'product_id' => 2,
        'check_in' => '2025-12-20',
        'check_out' => '2025-12-23',
        'guests' => 2,
        'notes' => 'API Test Booking',
        'total_price' => 0
    ]);
    echo "✓ Booking created: ID={$booking->id}\n";
    echo "  Check-in: {$booking->check_in}, Check-out: {$booking->check_out}\n";
    echo "  Guests: {$booking->guests}, Status: {$booking->status}\n\n";
} catch (\Exception $e) {
    echo "✗ Failed: {$e->getMessage()}\n\n";
}

// Test 2: Get booking with relationships
echo "=== TEST 2: GET BOOKING WITH RELATIONSHIPS ===\n";
try {
    $booking = Booking::with(['user', 'product'])->find(3);
    echo "✓ Booking found: ID={$booking->id}\n";
    echo "  User: {$booking->user->name} ({$booking->user->email})\n";
    echo "  Hotel: {$booking->product->name}\n";
    echo "  Status: {$booking->status}\n\n";
} catch (\Exception $e) {
    echo "✗ Failed: {$e->getMessage()}\n\n";
}

// Test 3: Update booking
echo "=== TEST 3: UPDATE BOOKING ===\n";
try {
    $booking = Booking::find(4);
    $booking->update(['notes' => 'Updated via API test']);
    echo "✓ Booking updated: ID={$booking->id}\n";
    echo "  New notes: {$booking->notes}\n\n";
} catch (\Exception $e) {
    echo "✗ Failed: {$e->getMessage()}\n\n";
}

// Test 4: Get hotels
echo "=== TEST 4: GET HOTELS ===\n";
try {
    $hotels = \App\Models\Hotel::limit(3)->get();
    echo "✓ Hotels retrieved: Count=" . count($hotels) . "\n";
    foreach ($hotels as $hotel) {
        echo "  - {$hotel->name} (\${$hotel->price})\n";
    }
    echo "\n";
} catch (\Exception $e) {
    echo "✗ Failed: {$e->getMessage()}\n\n";
}

// Test 5: Get roles with permissions
echo "=== TEST 5: GET ROLES WITH PERMISSIONS ===\n";
try {
    $roles = \Spatie\Permission\Models\Role::with('permissions')->get();
    echo "✓ Roles retrieved: Count=" . count($roles) . "\n";
    foreach ($roles as $role) {
        $permCount = $role->permissions->count();
        echo "  - {$role->name} ({$permCount} permissions)\n";
    }
    echo "\n";
} catch (\Exception $e) {
    echo "✗ Failed: {$e->getMessage()}\n\n";
}

// Test 6: Booking statistics
echo "=== TEST 6: BOOKING STATISTICS ===\n";
try {
    $totalBookings = Booking::count();
    $pendingBookings = Booking::where('status', 'pending')->count();
    $confirmedBookings = Booking::where('status', 'confirmed')->count();
    $cancelledBookings = Booking::where('status', 'cancelled')->count();
    
    echo "✓ Booking Stats:\n";
    echo "  Total: {$totalBookings}\n";
    echo "  Pending: {$pendingBookings}\n";
    echo "  Confirmed: {$confirmedBookings}\n";
    echo "  Cancelled: {$cancelledBookings}\n\n";
} catch (\Exception $e) {
    echo "✗ Failed: {$e->getMessage()}\n\n";
}

echo "=== ALL TESTS COMPLETED ===\n";
