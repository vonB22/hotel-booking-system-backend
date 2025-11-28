<?php
// Quick test of the cache-clear endpoint locally
$token = '29|pu6VVdNJrGwchrx66Dp3qBKuPUfj7EGfn3Mzg8yQO3a5cf17';

echo "Testing /api/debug/cache-clear endpoint locally...\n";
echo "========================================\n\n";

$ch = curl_init('http://localhost:8000/api/debug/cache-clear');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token,
    ],
]);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "HTTP Code: $code\n\n";

if ($error) {
    echo "Curl Error: $error\n";
}

echo "Response:\n";
echo $response . "\n\n";

// Try to parse as JSON
$data = json_decode($response, true);
if (is_array($data)) {
    echo "Parsed JSON:\n";
    print_r($data);
} else {
    echo "(Response is not valid JSON)\n";
}
?>
