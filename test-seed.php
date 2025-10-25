<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "Users: " . \App\Models\User::count() . "\n";
    echo "Categories: " . \App\Models\Category::count() . "\n";
    echo "Posts: " . \App\Models\Post::count() . "\n";
    echo "Sample Category Slugs:\n";
    foreach(\App\Models\Category::all() as $c) { echo "- {$c->slug} ({$c->name})\n"; }
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
