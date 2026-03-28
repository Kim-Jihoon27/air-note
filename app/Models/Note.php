<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'pinned_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'pinned_at' => 'datetime',
    ];

    // Auto-generate title from content if not provided
    public static function boot()
    {
        parent::boot();

        static::saving(function ($note) {
            if (empty($note->title) && !empty($note->content)) {
                $note->title = Str::limit(strip_tags($note->content), 50);
            }
        });
    }

    // Get preview text (first 100 chars)
    public function getPreviewAttribute(): string
    {
        return Str::limit(strip_tags($this->content), 100);
    }

    // Check if note is pinned
    public function getIsPinnedAttribute(): bool
    {
        return $this->pinned_at !== null;
    }

    // Scope for pinned notes
    public function scopePinned($query)
    {
        return $query->whereNotNull('pinned_at');
    }

    // Scope for unpinned notes
    public function scopeUnpinned($query)
    {
        return $query->whereNull('pinned_at');
    }

    // Toggle pin status
    public function togglePin()
    {
        $this->pinned_at = $this->is_pinned ? null : now();
        $this->save();
    }
}