<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;

$user = User::find(1);
if ($user) {
    $token = $user->createToken('test-token')->plainTextToken;
    echo "API Token for user {$user->email}: \n";
    echo $token . "\n";
} else {
    echo "No admin user found (ID=1)\n";
}
