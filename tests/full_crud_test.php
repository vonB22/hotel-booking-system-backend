<?php
/**
 * Comprehensive test of all user and role CRUD operations
 */

$BASE_URL = 'https://hotel-booking-system-backend-0tc6.onrender.com';
$ADMIN_EMAIL = 'admin@gmail.com';
$ADMIN_PASSWORD = 'admin123';

echo "Full CRUD Testing - Users & Roles\n";
echo "=================================\n\n";

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

// Login
$result = makeRequest('POST', "$BASE_URL/api/login", [
    'email' => $ADMIN_EMAIL,
    'password' => $ADMIN_PASSWORD
]);
$token = $result['body']['data']['plainTextToken'];
echo "✅ Logged in as admin\n\n";

// TEST 1: CREATE USER
echo "TEST 1: CREATE USER (POST /api/users)\n";
echo "-------------------------------------\n";
$newUserName = 'TestUser' . time();
$newUserEmail = 'testuser' . time() . '@test.com';
$result = makeRequest('POST', "$BASE_URL/api/users", [
    'name' => $newUserName,
    'email' => $newUserEmail,
    'password' => 'password123',
    'password_confirmation' => 'password123',
    'role' => 'User'
], $token);

if ($result['code'] === 201) {
    echo "✅ CREATE USER: SUCCESS (HTTP 201)\n";
    $newUserId = $result['body']['data']['id'];
    echo "Created user ID: $newUserId\n";
} else {
    echo "❌ CREATE USER: FAILED (HTTP {$result['code']})\n";
    echo "Response: " . json_encode($result['body'], JSON_PRETTY_PRINT) . "\n";
    $newUserId = 2; // fallback to existing user
}
echo "\n";

// TEST 2: READ USER
echo "TEST 2: READ USER (GET /api/users/{$newUserId})\n";
echo "-------------------------------------\n";
$result = makeRequest('GET', "$BASE_URL/api/users/$newUserId", null, $token);
if ($result['code'] === 200) {
    echo "✅ READ USER: SUCCESS (HTTP 200)\n";
    echo "User: " . $result['body']['data']['name'] . "\n";
} else {
    echo "❌ READ USER: FAILED (HTTP {$result['code']})\n";
}
echo "\n";

// TEST 3: UPDATE USER
echo "TEST 3: UPDATE USER (PUT /api/users/{$newUserId})\n";
echo "-------------------------------------\n";
$result = makeRequest('PUT', "$BASE_URL/api/users/$newUserId", [
    'name' => 'Updated ' . $newUserName,
    'email' => $newUserEmail
], $token);

if ($result['code'] === 200) {
    echo "✅ UPDATE USER: SUCCESS (HTTP 200)\n";
    echo "Updated name: " . $result['body']['data']['name'] . "\n";
} else {
    echo "❌ UPDATE USER: FAILED (HTTP {$result['code']})\n";
    echo "Response: " . json_encode($result['body'], JSON_PRETTY_PRINT) . "\n";
}
echo "\n";

// TEST 4: CREATE ROLE
echo "TEST 4: CREATE ROLE (POST /api/roles)\n";
echo "-------------------------------------\n";
$newRoleName = 'TestRole' . time();
$result = makeRequest('POST', "$BASE_URL/api/roles", [
    'name' => $newRoleName,
    'permissions' => []
], $token);

if ($result['code'] === 201) {
    echo "✅ CREATE ROLE: SUCCESS (HTTP 201)\n";
    $newRoleId = $result['body']['data']['id'];
    echo "Created role ID: $newRoleId\n";
} else {
    echo "❌ CREATE ROLE: FAILED (HTTP {$result['code']})\n";
    echo "Response: " . json_encode($result['body'], JSON_PRETTY_PRINT) . "\n";
    $newRoleId = 3;
}
echo "\n";

// TEST 5: READ ROLE
echo "TEST 5: READ ROLE (GET /api/roles/{$newRoleId})\n";
echo "-------------------------------------\n";
$result = makeRequest('GET', "$BASE_URL/api/roles/$newRoleId", null, $token);
if ($result['code'] === 200) {
    echo "✅ READ ROLE: SUCCESS (HTTP 200)\n";
    echo "Role: " . $result['body']['data']['name'] . "\n";
} else {
    echo "❌ READ ROLE: FAILED (HTTP {$result['code']})\n";
}
echo "\n";

// TEST 6: UPDATE ROLE
echo "TEST 6: UPDATE ROLE (PUT /api/roles/{$newRoleId})\n";
echo "-------------------------------------\n";
$result = makeRequest('PUT', "$BASE_URL/api/roles/$newRoleId", [
    'name' => 'Updated ' . $newRoleName,
    'permissions' => []
], $token);

if ($result['code'] === 200) {
    echo "✅ UPDATE ROLE: SUCCESS (HTTP 200)\n";
    echo "Updated name: " . $result['body']['data']['name'] . "\n";
} else {
    echo "❌ UPDATE ROLE: FAILED (HTTP {$result['code']})\n";
    echo "Response: " . json_encode($result['body'], JSON_PRETTY_PRINT) . "\n";
}
echo "\n";

// TEST 7: DELETE USER
echo "TEST 7: DELETE USER (DELETE /api/users/{$newUserId})\n";
echo "-------------------------------------\n";
$result = makeRequest('DELETE', "$BASE_URL/api/users/$newUserId", null, $token);
if ($result['code'] === 200) {
    echo "✅ DELETE USER: SUCCESS (HTTP 200)\n";
} else {
    echo "❌ DELETE USER: FAILED (HTTP {$result['code']})\n";
}
echo "\n";

// TEST 8: DELETE ROLE
echo "TEST 8: DELETE ROLE (DELETE /api/roles/{$newRoleId})\n";
echo "-------------------------------------\n";
$result = makeRequest('DELETE', "$BASE_URL/api/roles/$newRoleId", null, $token);
if ($result['code'] === 200) {
    echo "✅ DELETE ROLE: SUCCESS (HTTP 200)\n";
} else {
    echo "❌ DELETE ROLE: FAILED (HTTP {$result['code']})\n";
}
echo "\n";

echo "=================================\n";
echo "All Tests Complete!\n";
?>
