<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Create sample tags
$tags = [
    ['name' => 'Laravel', 'slug' => 'laravel', 'color' => '#FF2D20'],
    ['name' => 'PHP', 'slug' => 'php', 'color' => '#777BB4'],
    ['name' => 'JavaScript', 'slug' => 'javascript', 'color' => '#F7DF1E'],
    ['name' => 'Tutorial', 'slug' => 'tutorial', 'color' => '#10B981'],
    ['name' => 'Tips', 'slug' => 'tips', 'color' => '#3B82F6'],
    ['name' => 'Web Development', 'slug' => 'web-development', 'color' => '#8B5CF6'],
    ['name' => 'Beginner', 'slug' => 'beginner', 'color' => '#F59E0B'],
    ['name' => 'Advanced', 'slug' => 'advanced', 'color' => '#EF4444'],
];

foreach ($tags as $tagData) {
    App\Models\Tag::firstOrCreate(['slug' => $tagData['slug']], $tagData);
}

echo "✅ Tags created successfully!\n";
echo "Total tags: " . App\Models\Tag::count() . "\n\n";

// Attach random tags to posts
$posts = App\Models\Post::all();
$allTags = App\Models\Tag::all();

foreach ($posts as $post) {
    // Attach 2-4 random tags to each post
    $randomTags = $allTags->random(rand(2, 4));
    $post->tags()->syncWithoutDetaching($randomTags->pluck('id')->toArray());
    echo "✅ Attached " . $randomTags->count() . " tags to post: " . $post->title . "\n";
}

echo "\n🎉 Done! All posts now have tags!\n";
