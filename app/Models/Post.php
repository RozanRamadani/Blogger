<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'body', 'author_id', 'category_id', 'image'];
    protected $with = ['author', 'category'];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        // Clear cache when post is created, updated, or deleted
        static::created(function () {
            Cache::tags(['posts'])->flush();
        });

        static::updated(function () {
            Cache::tags(['posts'])->flush();
        });

        static::deleted(function () {
            Cache::tags(['posts'])->flush();
        });
    }

    public function author(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo 
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, fn ($query, $search) =>
            $query->where('title', 'like', '%' . $search . '%')
        );

        $query->when($filters['category'] ?? false, fn ($query, $category) =>
            $query->whereHas('category', fn ($query) =>
                $query->where('slug', $category)
            )
        );

        $query->when($filters['author'] ?? false, fn ($query, $author) =>
            $query->whereHas('author', fn ($query) =>
                $query->where('username', $author)
            )
        );
    }
}
