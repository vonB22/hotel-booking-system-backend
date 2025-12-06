<?php

require_once 'vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "=== StayEase Email Configuration Test ===\n\n";

// Display current mail configuration
echo "Mail Configuration:\n";
echo "MAILER: " . env('MAIL_MAILER') . "\n";
echo "HOST: " . env('MAIL_HOST') . "\n";
echo "PORT: " . env('MAIL_PORT') . "\n";
echo "USERNAME: " . env('MAIL_USERNAME') . "\n";
echo "ENCRYPTION: " . env('MAIL_ENCRYPTION') . "\n";
echo "FROM ADDRESS: " . env('MAIL_FROM_ADDRESS') . "\n";
echo "FROM NAME: " . env('MAIL_FROM_NAME') . "\n\n";

// Verify SMTP credentials are set
if (empty(env('MAIL_USERNAME')) || empty(env('MAIL_PASSWORD'))) {
    echo "❌ ERROR: Mail credentials not configured in .env\n";
    exit(1);
}

echo "✅ Mail credentials are configured\n";
echo "✅ Ready to test email sending\n\n";

echo "To test email sending, use the following commands:\n";
echo "1. php artisan tinker\n";
echo "2. \$user = new stdClass(); \$user->name = 'Test'; \$user->email = 'your-email@gmail.com';\n";
echo "3. Mail::to(\$user->email)->send(new App\\Mail\\RegistrationEmail(App\\Models\\User::first() ?? \$user));\n";
