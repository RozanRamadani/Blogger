<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        

        // Category::create([
        //     'name' => 'Web Programming',
        //     'slug' => 'web-programming'
        // ]);

        // Post::create([
        //     'title' => 'Judul Artikel Pertama',
        //     'author_id' => 1,
        //     'category_id' => 1,
        //     'slug' => 'judul-artikel-pertama',
        //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Impedit deleniti reprehenderit nisi aliquid, officia enim numquam velit dolorem, cupiditate laudantium obcaecati iure consequuntur ratione aperiam error, praesentium debitis iusto? Assumenda?'
        // ]);

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
        ]);

        Post::factory(20)->recycle([
            Category::all(),
            User::all()
        ])->create();
    }
}
