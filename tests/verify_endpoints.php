<?php
/**
 * Verify all API endpoints are working correctly
 * Tests login, token generation, and CRUD operations
 */

// Configuration
$BASE_URL = 'https://hotel-booking-system-backend-0tc6.onrender.com';
// For local testing:
// $BASE_URL = 'http://localhost:8000';

$ADMIN_EMAIL = 'admin@gmail.com';
$ADMIN_PASSWORD = 'admin123';

echo "========================================\n";
echo "Hotel Booking API - Endpoint Verification\n";
echo "========================================\n\n";

// Helper function to make HTTP requests
function makeRequest($method, $url, $data = null, $token = null) {
    $ch = curl_init();
    
    $headers = [
        'Content-Type: application/json',
        'Accept: application/json',
    ];
    
    if ($token) {
        $headers[] = "Authorization: Bearer $token";
    }
    
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
    ]);
    
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    return [
        'code' => $httpCode,
        'body' => json_decode($response, true),
        'error' => $error,
        'raw' => $response,
    ];
}

// 1. Test public endpoints
echo "1. Testing Public Endpoints\n";
echo "----------------------------\n";

// Get hotels list
echo "GET /api/hotels... ";
$result = makeRequest('GET', "$BASE_URL/api/hotels");
if ($result['code'] === 200) {
    echo "✅ OK\n";
} else {
    echo "❌ FAILED (HTTP {$result['code']})\n";
    echo "Response: " . json_encode($result['body']) . "\n";
}

// 2. Test authentication
echo "\n2. Testing Authentication\n";
echo "------------------------\n";

echo "POST /api/login (admin@gmail.com)... ";
$loginResult = makeRequest('POST', "$BASE_URL/api/login", [
    'email' => $ADMIN_EMAIL,
    'password' => $ADMIN_PASSWORD
]);

if ($loginResult['code'] === 200 && (isset($loginResult['body']['token']) || isset($loginResult['body']['data']['plainTextToken']))) {
    echo "✅ OK\n";
    $token = $loginResult['body']['token'] ?? $loginResult['body']['data']['plainTextToken'];
    echo "Token: " . substr($token, 0, 20) . "...\n";
} else {
    echo "❌ FAILED (HTTP {$loginResult['code']})\n";
    echo "Response: " . json_encode($loginResult['body']) . "\n";
    exit(1);
}

// 3. Test protected endpoints
echo "\n3. Testing Protected Endpoints\n";
echo "------------------------------\n";

// Get current user
echo "GET /api/user (authenticated)... ";
$userResult = makeRequest('GET', "$BASE_URL/api/user", null, $token);
if ($userResult['code'] === 200) {
    echo "✅ OK (User: {$userResult['body']['name']})\n";
} else {
    echo "❌ FAILED (HTTP {$userResult['code']})\n";
    echo "Response: " . json_encode($userResult['body']) . "\n";
}

// Get user roles and permissions
echo "GET /api/debug/user-roles... ";
$rolesResult = makeRequest('GET', "$BASE_URL/api/debug/user-roles", null, $token);
if ($rolesResult['code'] === 200) {
    echo "✅ OK\n";
    if ($rolesResult['body']['is_admin'] ?? false) {
        echo "  ✅ Admin role confirmed\n";
    } else {
        echo "  ❌ Not admin!\n";
    }
    
    // Show permission status
    foreach (['hotel_create_permission', 'hotel_edit_permission', 'hotel_delete_permission'] as $perm) {
        $status = $rolesResult['body'][$perm] ?? false ? '✅' : '❌';
        echo "  $status $perm\n";
    }
} else {
    echo "❌ FAILED (HTTP {$rolesResult['code']})\n";
    echo "Response: " . json_encode($rolesResult['body']) . "\n";
}

// 4. Test CRUD operations
echo "\n4. Testing Hotel CRUD Operations\n";
echo "--------------------------------\n";

// Create hotel
echo "POST /api/hotels (create new)... ";
$createData = [
    'name' => 'Test Hotel ' . date('His'),
    'description' => 'Test hotel for verification',
    'location' => 'Test City',
    'price' => 150.00,
    'rooms' => 20,
    'rating' => 4.5,
];

$createResult = makeRequest('POST', "$BASE_URL/api/hotels", $createData, $token);
if ($createResult['code'] === 201 || $createResult['code'] === 200) {
    echo "✅ OK\n";
    // Handle both response formats: {id:...} and {data:{id:...}}
    $responseData = $createResult['body']['data'] ?? $createResult['body'];
    $hotelId = $responseData['id'] ?? null;
    if ($hotelId) {
        echo "  Created hotel ID: $hotelId\n";
    }
} else {
    echo "❌ FAILED (HTTP {$createResult['code']})\n";
    echo "Response: " . json_encode($createResult['body']) . "\n";
    $hotelId = null;
}

// Update hotel
if ($hotelId) {
    echo "PUT /api/hotels/$hotelId (update)... ";
    $updateData = [
        'name' => 'Test Hotel Updated ' . date('His'),
        'price' => 200.00,
    ];
    
    $updateResult = makeRequest('PUT', "$BASE_URL/api/hotels/$hotelId", $updateData, $token);
    if ($updateResult['code'] === 200) {
        echo "✅ OK\n";
    } else {
        echo "❌ FAILED (HTTP {$updateResult['code']})\n";
        echo "Response: " . json_encode($updateResult['body']) . "\n";
    }
    
    // Get single hotel
    echo "GET /api/hotels/$hotelId (read)... ";
    $getResult = makeRequest('GET', "$BASE_URL/api/hotels/$hotelId", null, $token);
    if ($getResult['code'] === 200) {
        echo "✅ OK\n";
    } else {
        echo "❌ FAILED (HTTP {$getResult['code']})\n";
        echo "Response: " . json_encode($getResult['body']) . "\n";
    }
    
    // Delete hotel
    echo "DELETE /api/hotels/$hotelId (delete)... ";
    $deleteResult = makeRequest('DELETE', "$BASE_URL/api/hotels/$hotelId", null, $token);
    if ($deleteResult['code'] === 200 || $deleteResult['code'] === 204) {
        echo "✅ OK\n";
    } else {
        echo "❌ FAILED (HTTP {$deleteResult['code']})\n";
        echo "Response: " . json_encode($deleteResult['body']) . "\n";
    }
}

// 5. Test cache clear endpoint
echo "\n5. Testing Cache Operations\n";
echo "---------------------------\n";

echo "POST /api/debug/cache-clear... ";
$cacheResult = makeRequest('POST', "$BASE_URL/api/debug/cache-clear", null, $token);
if ($cacheResult['code'] === 200) {
    echo "✅ OK\n";
    echo "  Message: " . ($cacheResult['body']['message'] ?? 'Cache cleared') . "\n";
} else {
    echo "❌ FAILED (HTTP {$cacheResult['code']})\n";
    echo "Response: " . json_encode($cacheResult['body']) . "\n";
}

echo "\n========================================\n";
echo "Verification Complete\n";
echo "========================================\n";
?>
