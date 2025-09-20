<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_bangla',
        'name_english',
        'slug',
        'description_bangla',
        'description_english',
        'color',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
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