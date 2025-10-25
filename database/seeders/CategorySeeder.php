<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(4)->create();
        $categories = [
            ['name' => 'Web Programming', 'slug' => 'web-programming', 'color' => 'blue'],
            ['name' => 'Web Design', 'slug' => 'web-design', 'color' => 'green'],
            ['name' => 'Mobile Development', 'slug' => 'mobile-development', 'color' => '#a78bfa'], // purple-400
            ['name' => 'UI/UX Design', 'slug' => 'ui-ux-design', 'color' => '#ef4444'], // red-500
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name'], 'color' => $cat['color']]
            );
        }
    }
}
