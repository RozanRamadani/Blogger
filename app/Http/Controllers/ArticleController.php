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
            'image' => 'nullable|image|max:2048',
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

        // Handle optional image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $postData['image'] = $path;
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
            'image' => 'nullable|image|max:2048',
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

        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = $request->file('image')->store('posts', 'public');
            $post->image = $path;
        }

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

        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted successfully');
    }
}
