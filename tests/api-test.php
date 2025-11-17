<?php
/**
 * Simple API Test Script
 * Run: php tests/api-test.php
 */

$base_url = 'http://127.0.0.1:8000';

function test_endpoint($method, $endpoint, $token = null) {
    global $base_url;
    
    $url = $base_url . $endpoint;
    
    $context_options = [
        'http' => [
            'method' => $method,
            'header' => [
                'Accept: application/json',
                'Content-Type: application/json',
            ],
        ]
    ];
    
    if ($token) {
        $context_options['http']['header'][] = 'Authorization: Bearer ' . $token;
    }
    
    $context = stream_context_create($context_options);
    
    try {
        $response = @file_get_contents($url, false, $context);
        $http_code = isset($http_response_header) ? $http_response_header[0] : 'Unknown';
        
        echo "\n" . str_repeat('=', 80) . "\n";
        echo "TEST: $method $endpoint\n";
        echo "Status: $http_code\n";
        echo "Response:\n";
        echo json_encode(json_decode($response, true), JSON_PRETTY_PRINT) . "\n";
        
        return true;
    } catch (Exception $e) {
        echo "\nERROR testing $endpoint: " . $e->getMessage() . "\n";
        return false;
    }
}

echo "Starting API Tests\n";
echo "Base URL: $base_url\n";

// Test 1: Public endpoint - Get Hotels
echo "\n\n TEST GROUP 1: Public Endpoints (No Authentication)\n";
test_endpoint('GET', '/api/hotels');

// Test 2: Get single hotel
test_endpoint('GET', '/api/hotels/1');

// Test 3: Protected endpoint - Get User (will fail without token)
echo "\n\n TEST GROUP 2: Protected Endpoints (Without Token - Should Fail)\n";
test_endpoint('GET', '/api/user');

echo "\n\n API Tests Complete!\n";
echo "\nNOTE: Protected endpoints failed because no token was provided.\n";
echo "To test authenticated endpoints:\n";
echo "1. Generate a token using: php artisan tinker\n";
echo "   \$user = App\\Models\\User::find(1);\n";
echo "   \$token = \$user->createToken('Test')->plainTextToken;\n";
echo "2. Update the test script with the token\n";
echo "3. Run tests again\n";
