<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Aswat extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Resolve the thumbnail to a usable URL: full URLs (e.g. YouTube
     * thumbnails) are returned as-is; otherwise treat it as a path on the
     * public disk (admin-uploaded thumbnails).
     */
    public function getThumbnailUrlAttribute(): string
    {
        $val = $this->thumbnail_image;
        if (!$val) {
            return '';
        }
        return Str::startsWith($val, ['http://', 'https://']) ? $val : Storage::url($val);
    }

    /**
     * Convert the stored link to an embeddable player URL for inline playback:
     *   - YouTube watch/short links → youtube.com/embed/<id>
     *   - Google Drive file links   → drive.google.com/file/d/<id>/preview
     * Returns null when the link isn't a recognised embeddable video (the view
     * then falls back to opening the link in a new tab).
     */
    public function getEmbedUrlAttribute(): ?string
    {
        $link = (string) $this->link;
        if ($link === '') {
            return null;
        }

        if (preg_match('~(?:youtube\.com/(?:watch\?v=|embed/)|youtu\.be/)([A-Za-z0-9_-]{11})~', $link, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1] . '?autoplay=1&rel=0';
        }

        if (preg_match('~drive\.google\.com/file/d/([A-Za-z0-9_-]+)~', $link, $m)) {
            return 'https://drive.google.com/file/d/' . $m[1] . '/preview';
        }

        return null;
    }
}
