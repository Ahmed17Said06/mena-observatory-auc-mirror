<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyBrief extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'ar_title',
        'description',
        'ar_description',
        'file_path',
        'image_path',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }
}
