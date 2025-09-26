<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Poem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_bangla',
        'title_english',
        'slug',
        'content_bangla',
        'content_english',
        'image_path',
        'youtube_embed_code',
        'summary_bangla',
        'summary_english',
        'user_id',
        'poet_id',
        'category_id',
        'is_published',
        'is_featured',
        'is_translation',
        'original_language',
        'views',
        'likes',
        'sort_order',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'is_translation' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function poet(): BelongsTo
    {
        return $this->belongsTo(Poet::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Sync tags for the poem
     */
    public function syncTags(array $tagNames)
    {
        $tags = collect($tagNames)->map(function ($name) {
            $slug = \Str::slug($name);
            
            // First try to find by slug
            $tag = \App\Models\Tag::where('slug', $slug)->first();
            
            if (!$tag) {
                // If not found, try to find by name_bangla
                $tag = \App\Models\Tag::where('name_bangla', $name)->first();
            }
            
            if (!$tag) {
                // If still not found, create new tag
                $tag = \App\Models\Tag::create([
                    'name_bangla' => $name,
                    'name_english' => $name,
                    'slug' => $slug
                ]);
            }
            
            return $tag;
        });

        $this->tags()->sync($tags->pluck('id'));
    }
}