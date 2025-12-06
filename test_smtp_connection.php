<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "=== Testing Gmail SMTP Connection ===\n\n";

$host = env('MAIL_HOST');
$port = env('MAIL_PORT');
$username = env('MAIL_USERNAME');
$password = env('MAIL_PASSWORD');

echo "Attempting to connect to: $host:$port\n";
echo "Username: $username\n\n";

// Test basic TCP connection
if ($socket = @fsockopen($host, $port, $errno, $errstr, 5)) {
    echo "✅ TCP Connection Successful\n";
    fclose($socket);
    
    // Now test SMTP authentication
    echo "\nAttempting SMTP authentication...\n";
    
    try {
        $smtp = fsockopen($host, $port, $errno, $errstr, 10);
        
        if (!$smtp) {
            echo "❌ Failed to connect to SMTP: $errstr ($errno)\n";
            exit(1);
        }
        
        $response = fgets($smtp, 1024);
        echo "Server: " . trim($response) . "\n";
        
        // Send EHLO
        fputs($smtp, "EHLO localhost\r\n");
        $response = fgets($smtp, 1024);
        echo "EHLO Response: " . trim($response) . "\n";
        
        // Start TLS
        fputs($smtp, "STARTTLS\r\n");
        $response = fgets($smtp, 1024);
        echo "STARTTLS Response: " . trim($response) . "\n";
        
        if (strpos($response, '220') !== false) {
            echo "\n✅ SMTP Connection Ready\n";
            echo "\nNext steps:\n";
            echo "1. Verify Gmail App Password is correct\n";
            echo "2. Ensure 2-Factor Authentication is enabled in Gmail\n";
            echo "3. Check Gmail security settings\n";
        }
        
        fclose($smtp);
        
    } catch (Exception $e) {
        echo "❌ SMTP Error: " . $e->getMessage() . "\n";
    }
    
} else {
    echo "❌ TCP Connection Failed: $errstr ($errno)\n";
    echo "\nPossible causes:\n";
    echo "1. Firewall blocking port 587\n";
    echo "2. Network connection issue\n";
    echo "3. Incorrect host or port\n";
}
