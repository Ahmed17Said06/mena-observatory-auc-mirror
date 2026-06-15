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
}
