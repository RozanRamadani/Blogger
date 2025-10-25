<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    echo "Testing navbar compilation...\n";
    $view = view('components.modern-navbar')->render();
    echo "Navbar: SUCCESS! (" . strlen($view) . " bytes)\n\n";
    
    echo "Testing footer compilation...\n";
    $view = view('components.modern-footer')->render();
    echo "Footer: SUCCESS! (" . strlen($view) . " bytes)\n\n";
    
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
