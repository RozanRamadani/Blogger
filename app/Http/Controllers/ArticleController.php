<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->author_id = Auth::id();
        $post->category_id = $validated['category_id'];
        $post->slug = Str::slug($validated['title']) . '-' . uniqid();
        $post->save();

        return redirect()->back()->with('success', 'Article posted!');
    }
}
