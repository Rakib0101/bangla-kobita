<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_bangla',
        'name_english',
        'slug',
        'biography_bangla',
        'biography_english',
        'birth_date',
        'death_date',
        'birth_place',
        'image',
        'is_active',
        'is_featured',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'birth_date' => 'date',
        'death_date' => 'date',
    ];

    public function poems(): HasMany
    {
        return $this->hasMany(Poem::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}