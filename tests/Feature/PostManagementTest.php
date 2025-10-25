<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\{User, Post, Category};

class PostManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_author_can_update_and_replace_image()
    {
        Storage::fake('public');

    // disable CSRF for test requests
    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->create();
        $category = Category::factory()->create();

        // create an old image file
        Storage::disk('public')->put('posts/old.jpg', 'old');

        $post = Post::factory()->create([
            'author_id' => $user->id,
            'category_id' => $category->id,
            'image' => 'posts/old.jpg',
        ]);

        $newFile = UploadedFile::fake()->image('new.jpg');

        $token = 'test-token';
        $this->withSession(['_token' => $token]);

        $response = $this->actingAs($user)->put(route('articles.update', $post->slug), [
            '_token' => $token,
            'title' => 'Updated Title',
            'body' => 'Updated body content',
            'category_id' => $category->id,
            'image' => $newFile,
        ]);

        $response->assertRedirect();

        // old file deleted
        Storage::disk('public')->assertMissing('posts/old.jpg');

        $post->refresh();

        $this->assertEquals('Updated Title', $post->title);
        Storage::disk('public')->assertExists($post->image);
    }

    public function test_unauthorized_user_cannot_update_or_delete()
    {
    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $category = Category::factory()->create();

        $post = Post::factory()->create([
            'author_id' => $owner->id,
            'category_id' => $category->id,
        ]);

        $token = 'test-token';
        $this->withSession(['_token' => $token]);

        $response = $this->actingAs($other)->put(route('articles.update', $post->slug), [
            '_token' => $token,
            'title' => 'Hacked',
            'body' => 'bad',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(403);

        $del = $this->actingAs($other)->delete(route('articles.destroy', $post->slug));
        $del->assertStatus(403);
    }

    public function test_delete_removes_db_record_and_image()
    {
        Storage::fake('public');

    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

        $user = User::factory()->create();
        $category = Category::factory()->create();

        Storage::disk('public')->put('posts/todelete.jpg', 'content');

        $post = Post::factory()->create([
            'author_id' => $user->id,
            'category_id' => $category->id,
            'image' => 'posts/todelete.jpg',
        ]);

    $token = 'test-token';
    $this->withSession(['_token' => $token]);

    $resp = $this->actingAs($user)->delete(route('articles.destroy', $post->slug), ['_token' => $token]);

    $resp->assertRedirect('/posts');

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
        Storage::disk('public')->assertMissing('posts/todelete.jpg');
    }
}
