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
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date|after_or_equal:now',
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
            'status' => $validated['status'],
            'published_at' => $validated['status'] === 'scheduled' ? $validated['published_at'] : ($validated['status'] === 'published' ? now() : null),
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

        // Attach tags if provided
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }

        $message = match($validated['status']) {
            'draft' => 'Article saved as draft!',
            'scheduled' => 'Article scheduled for ' . \Carbon\Carbon::parse($validated['published_at'])->format('M d, Y g:i A'),
            default => 'Article published!'
        };

        return redirect()->back()->with('success', $message);
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
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:draft,published,scheduled',
            'published_at' => 'nullable|date',
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
        $post->status = $validated['status'];

        // Handle published_at based on status
        if ($validated['status'] === 'scheduled') {
            $post->published_at = $validated['published_at'];
        } elseif ($validated['status'] === 'published' && !$post->published_at) {
            $post->published_at = now();
        } elseif ($validated['status'] === 'draft') {
            $post->published_at = null;
        }

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

        // Sync tags
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        $message = match($validated['status']) {
            'draft' => 'Post saved as draft!',
            'scheduled' => 'Post scheduled for ' . \Carbon\Carbon::parse($validated['published_at'])->format('M d, Y g:i A'),
            default => 'Post updated successfully!'
        };

        return redirect()->route('articles.edit', $post->slug)->with('success', $message);
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
