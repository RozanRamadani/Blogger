<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Toggle like on a post.
     */
    public function toggleLike(Post $post)
    {
        $user = Auth::user();

        if ($post->isLikedBy($user)) {
            $post->likes()->detach($user->id);
            $liked = false;
        } else {
            $post->likes()->attach($user->id);
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked' => $liked,
            'likes_count' => $post->likes()->count(),
        ]);
    }

    /**
     * Toggle bookmark on a post.
     */
    public function toggleBookmark(Post $post)
    {
        $user = Auth::user();

        if ($post->isBookmarkedBy($user)) {
            $post->bookmarks()->detach($user->id);
            $bookmarked = false;
        } else {
            $post->bookmarks()->attach($user->id);
            $bookmarked = true;
        }

        return response()->json([
            'success' => true,
            'bookmarked' => $bookmarked,
            'bookmarks_count' => $post->bookmarks()->count(),
        ]);
    }
}
