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
}