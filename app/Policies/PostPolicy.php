<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     */
    public function view(User $user, Post $post): bool
    {
        return true; // public
    }

    /**
     * Determine whether the user can create posts.
     */
    public function create(User $user): bool
    {
        return $user !== null;
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        // Allow the author or an admin (identified by ADMIN_EMAIL or username 'admin')
        if ($user->id === $post->author_id) return true;
        if (env('ADMIN_EMAIL') && $user->email === env('ADMIN_EMAIL')) return true;
        if ($user->username === 'admin') return true;
        return false;
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $this->update($user, $post);
    }
}
