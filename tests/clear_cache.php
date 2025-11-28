<?php
/**
 * Manual cache clearing script for production Render
 * Calls the /api/debug/cache-clear endpoint
 */

// First, login to get a token
echo "Step 1: Logging in...\n";
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'https://hotel-booking-system-backend-0tc6.onrender.com/api/login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Accept: application/json',
    ],
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode([
        'email' => 'admin@gmail.com',
        'password' => 'admin123'
    ]),
    CURLOPT_SSL_VERIFYPEER => false,
]);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($code !== 200) {
    echo "❌ Login failed (HTTP $code)\n";
    echo $response . "\n";
    exit(1);
}

$data = json_decode($response, true);
$token = $data['data']['plainTextToken'] ?? null;

if (!$token) {
    echo "❌ No token in response\n";
    echo $response . "\n";
    exit(1);
}

echo "✅ Login successful\n";
echo "Token: " . substr($token, 0, 20) . "...\n\n";

// Now clear the cache
echo "Step 2: Clearing cache...\n";
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'https://hotel-booking-system-backend-0tc6.onrender.com/api/debug/cache-clear',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer ' . $token,
    ],
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_SSL_VERIFYPEER => false,
]);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP $code\n";
$data = json_decode($response, true);
if ($data) {
    echo json_encode($data, JSON_PRETTY_PRINT) . "\n";
} else {
    echo $response . "\n";
}

if ($code === 200) {
    echo "\n✅ Cache cleared successfully!\n";
    echo "\nStep 3: Checking permissions...\n";
    
    // Check permissions after cache clear
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => 'https://hotel-booking-system-backend-0tc6.onrender.com/api/debug/user-roles',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer ' . $token,
        ],
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_SSL_VERIFYPEER => false,
    ]);
    
    $response = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    $data = json_decode($response, true);
    echo "\nUser Roles & Permissions:\n";
    echo "  Admin: " . ($data['is_admin'] ? '✅ YES' : '❌ NO') . "\n";
    echo "  hotel_create_permission: " . ($data['hotel_create_permission'] ? '✅ YES' : '❌ NO') . "\n";
    echo "  hotel_edit_permission: " . ($data['hotel_edit_permission'] ? '✅ YES' : '❌ NO') . "\n";
    echo "  hotel_delete_permission: " . ($data['hotel_delete_permission'] ? '✅ YES' : '❌ NO') . "\n";
    
} else {
    echo "\n❌ Cache clear failed!\n";
    exit(1);
}
?>
