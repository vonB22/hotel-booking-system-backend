<?php

use Illuminate\Foundation\Application;
use Symfony\Component\Console\Input\ArgvInput;

define('LARAVEL_START', microtime(true));

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Register the Composer autoloader...
require __DIR__.'/vendor/autoload.php';

// Bootstrap Laravel and handle the command...
try {
    echo "Bootstrap starting...\n";
    /** @var Application $app */
    $app = require_once __DIR__.'/bootstrap/app.php';
    echo "Bootstrap complete!\n";
    
    echo "Handling command...\n";
    try {
        $status = $app->handleCommand(new ArgvInput);
    } catch (Throwable $e) {
        echo "COMMAND ERROR:\n";
        echo "Class: " . get_class($e) . "\n";
        echo "Message: " . $e->getMessage() . "\n";
        echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
        echo "\nFirst 5 stack frames:\n";
        $trace = $e->getTrace();
        for ($i = 0; $i < min(5, count($trace)); $i++) {
            $frame = $trace[$i];
            echo "  " . ($frame['file'] ?? 'unknown') . ":" . ($frame['line'] ?? '?') . " in " . ($frame['function'] ?? '?') . "\n";
        }
        throw $e;
    }
    exit($status);
} catch (Throwable $e) {
    echo "\nFATAL ERROR:\n";
    echo $e->getMessage() . "\n";
    exit(1);
}

?>
