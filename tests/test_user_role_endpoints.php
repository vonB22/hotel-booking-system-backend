<?php
/**
 * Test user and role management endpoints
 */

$BASE_URL = 'https://hotel-booking-system-backend-0tc6.onrender.com';
$ADMIN_EMAIL = 'admin@gmail.com';
$ADMIN_PASSWORD = 'admin123';

echo "Testing User & Role Management Endpoints\n";
echo "========================================\n\n";

// Helper function
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
    ]);
    
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'code' => $httpCode,
        'body' => json_decode($response, true),
    ];
}

// Step 1: Login
echo "Step 1: Login as admin\n";
$result = makeRequest('POST', "$BASE_URL/api/login", [
    'email' => $ADMIN_EMAIL,
    'password' => $ADMIN_PASSWORD
]);

if ($result['code'] !== 200) {
    echo "❌ Login failed\n";
    print_r($result);
    exit(1);
}

$token = $result['body']['data']['plainTextToken'];
echo "✅ Login successful\n";
echo "Token: " . substr($token, 0, 20) . "...\n\n";

// Step 2: Check admin roles
echo "Step 2: Check admin user roles\n";
$result = makeRequest('GET', "$BASE_URL/api/debug/user-roles", null, $token);
echo "Status: " . ($result['body']['is_admin'] ? "✅ ADMIN" : "❌ NOT ADMIN") . "\n";
echo "User roles: " . json_encode($result['body']['roles'] ?? []) . "\n\n";

// Step 3: Try to GET users
echo "Step 3: GET /api/users\n";
$result = makeRequest('GET', "$BASE_URL/api/users", null, $token);
if ($result['code'] === 200) {
    echo "✅ Success (HTTP {$result['code']})\n";
    echo "Users count: " . count($result['body']['data'] ?? []) . "\n";
} else {
    echo "❌ Failed (HTTP {$result['code']})\n";
    echo "Error: " . ($result['body']['message'] ?? 'Unknown error') . "\n";
    echo "Details: " . ($result['body']['error'] ?? '') . "\n";
}
echo "\n";

// Step 4: Try to POST create user
echo "Step 4: POST /api/users (create new user)\n";
$result = makeRequest('POST', "$BASE_URL/api/users", [
    'name' => 'Test User ' . time(),
    'email' => 'test' . time() . '@example.com',
    'password' => 'password123',
    'password_confirmation' => 'password123',
    'role' => 'User'
], $token);

if ($result['code'] === 201) {
    echo "✅ Success (HTTP {$result['code']})\n";
    echo "Created user: " . $result['body']['data']['name'] . "\n";
} else {
    echo "❌ Failed (HTTP {$result['code']})\n";
    echo "Error: " . ($result['body']['message'] ?? 'Unknown error') . "\n";
    echo "Details: " . ($result['body']['error'] ?? '') . "\n";
}
echo "\n";

// Step 5: Try to GET roles
echo "Step 5: GET /api/roles\n";
$result = makeRequest('GET', "$BASE_URL/api/roles", null, $token);
if ($result['code'] === 200) {
    echo "✅ Success (HTTP {$result['code']})\n";
    echo "Roles count: " . count($result['body']['data'] ?? []) . "\n";
} else {
    echo "❌ Failed (HTTP {$result['code']})\n";
    echo "Error: " . ($result['body']['message'] ?? 'Unknown error') . "\n";
    echo "Details: " . ($result['body']['error'] ?? '') . "\n";
}
echo "\n";

// Step 6: Try to POST create role
echo "Step 6: POST /api/roles (create new role)\n";
$result = makeRequest('POST', "$BASE_URL/api/roles", [
    'name' => 'TestRole' . time(),
    'permissions' => []
], $token);

if ($result['code'] === 201) {
    echo "✅ Success (HTTP {$result['code']})\n";
    echo "Created role: " . $result['body']['data']['name'] . "\n";
} else {
    echo "❌ Failed (HTTP {$result['code']})\n";
    echo "Error: " . ($result['body']['message'] ?? 'Unknown error') . "\n";
    echo "Details: " . ($result['body']['error'] ?? '') . "\n";
}
echo "\n";

echo "========================================\n";
echo "Test Complete\n";
?>
