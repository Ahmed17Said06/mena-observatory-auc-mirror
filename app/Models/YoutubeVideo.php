<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Repo_tags;

class YoutubeVideo extends Model
{
    use HasFactory;

    public function tags()
    {
        return $this->morphToMany(Repo_tags::class, 'taggable');
    }

    protected $table = 'youtube_videos';

    protected $fillable = [
        'title',
        'ar_title',
        'youtube_url',
        'description',
        'ar_description',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    /**
     * Extract YouTube video ID from various URL formats.
     */
    public function getYoutubeIdAttribute(): ?string
    {
        $url = $this->youtube_url;

        // Match youtube.com/watch?v=ID
        if (preg_match('/[?&]v=([^&#]+)/', $url, $matches)) {
            return $matches[1];
        }

        // Match youtu.be/ID
        if (preg_match('/youtu\.be\/([^?&#]+)/', $url, $matches)) {
            return $matches[1];
        }

        // Match youtube.com/embed/ID
        if (preg_match('/youtube\.com\/embed\/([^?&#]+)/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    /**
     * Get the embed URL for the video.
     */
    public function getEmbedUrlAttribute(): ?string
    {
        $id = $this->youtube_id;
        return $id ? "https://www.youtube.com/embed/{$id}" : null;
    }

    /**
     * Get the thumbnail URL for the video.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        $id = $this->youtube_id;
        return $id ? "https://img.youtube.com/vi/{$id}/maxresdefault.jpg" : null;
    }

    /**
     * Scope for published videos.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}
