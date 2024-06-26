<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $with = ['category', 'author'];

    // protected $fillable = ['title']; // Enable mass-assignment

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where(
                fn ($query) =>
                $query
                    ->where('title', 'like', "%$search%")
                    ->orWhere('body', 'like', "%$search%")
            )
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('slug', $category)
            )
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) =>
            $query->whereHas(
                'author',
                fn ($query) =>
                $query->where('username', $author)
            )
        );
    }

    public function setSlugAttribute($title)
    {
        $slug = Str::slug($title);

        // Check if exists in DB
        $existingSlug = static::whereSlug($slug)->exists();

        // If the slug exists in DB, add new number to the end
        if ($existingSlug) {
            $count = 1;
            do {
                $newSlug = $slug . '-' . $count;
                $count++;
            } while (static::whereSlug($newSlug)->exists());
            $this->attributes['slug'] = $newSlug;
        } else {
            $this->attributes['slug'] = $slug;
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function path(): String
    {
        return '/post/' . $this->slug;
    }
}
