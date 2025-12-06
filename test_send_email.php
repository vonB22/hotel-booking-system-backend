<?php

require_once 'vendor/autoload.php';

use Illuminate\Mail\Mailer;
use Illuminate\Mail\Transport\SmtpTransport;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Testing Email Send with New Password ===\n\n";

try {
    // Create a test user object
    $testUser = new stdClass();
    $testUser->name = 'Test User';
    $testUser->email = 'souei0922@gmail.com'; // Replace with your email
    $testUser->id = 1;
    
    // Cast to User model to pass to Mailable
    $user = new \App\Models\User();
    $user->name = $testUser->name;
    $user->email = $testUser->email;
    
    echo "Attempting to send registration email to: {$user->email}\n";
    echo "User name: {$user->name}\n\n";
    
    // Send the email
    \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\RegistrationEmail($user));
    
    echo "✅ Email sent successfully!\n";
    echo "Check your inbox at: {$user->email}\n";
    
} catch (\Exception $e) {
    echo "❌ Email send failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nStack Trace:\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
}
