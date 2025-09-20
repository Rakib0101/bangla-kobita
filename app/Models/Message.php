<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message_bangla',
        'message_english',
        'message_type',
        'file_path',
        'is_edited',
        'edited_at'
    ];

    protected $casts = [
        'is_edited' => 'boolean',
        'edited_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the formatted message for display
     */
    public function getFormattedMessageAttribute(): string
    {
        return $this->message_bangla;
    }

    /**
     * Get the time ago format
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}
