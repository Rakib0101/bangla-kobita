<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_bangla',
        'name_english',
        'slug',
        'color',
        'is_active',
        'usage_count'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function poems(): BelongsToMany
    {
        return $this->belongsToMany(Poem::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}