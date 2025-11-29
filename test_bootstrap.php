<?php

try {
    echo "1. Loading autoload...\n";
    require 'vendor/autoload.php';
    echo "   OK\n";
    
    echo "2. Bootstrapping app...\n";
    $app = require 'bootstrap/app.php';
    echo "   OK\n";
    
    echo "3. All tests passed!\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "Stack: " . $e->getTraceAsString() . "\n";
    exit(1);
}

?>
