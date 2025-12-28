<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Build a readable slug and ensure uniqueness
        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $postData = [
            'title' => $validated['title'],
            'body' => $validated['body'],
            'author_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'slug' => $slug,
        ];

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');
                $imagePaths[] = $path;
            }
            $postData['images'] = $imagePaths;
        }

        $post = Post::create($postData);

        return redirect()->back()->with('success', 'Article posted!');
    }

    /**
     * Show edit form for a post.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = \App\Models\Category::all();
        return view('edit-post', [
            'title' => 'Edit Post',
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified post.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|max:2048',
            'remove_images' => 'nullable|array',
        ]);

        // Update slug if title changed
        if ($validated['title'] !== $post->title) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $counter = 1;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $post->slug = $slug;
        }

        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->category_id = $validated['category_id'];

        // Combine all existing images (from both image and images fields)
        $existingImages = [];
        if ($post->image) {
            $existingImages[] = $post->image;
        }
        if ($post->images && is_array($post->images)) {
            $existingImages = array_merge($existingImages, $post->images);
        }

        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageToRemove) {
                if (($key = array_search($imageToRemove, $existingImages)) !== false) {
                    Storage::disk('public')->delete($imageToRemove);
                    unset($existingImages[$key]);
                }
            }
            $existingImages = array_values($existingImages); // Re-index array
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('posts', 'public');
                $existingImages[] = $path;
            }
        }

        // Save all images to images field and clear old image field
        $post->images = $existingImages;
        $post->image = null; // Clear old single image field
        $post->save();

        return redirect()->route('articles.edit', $post->slug)->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // delete image if exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // delete multiple images if exists
        if ($post->images && is_array($post->images)) {
            foreach ($post->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted successfully');
    }
}
