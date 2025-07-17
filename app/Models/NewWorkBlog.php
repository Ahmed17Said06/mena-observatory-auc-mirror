<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewWorkBlog extends Model // Rename from Report to NewWorkBlog
{
    protected $table = 'new_work_blogs'; // Add this line
    
    protected $fillable = [
        'title',
        'description', 
        'file_path',
        'image_path',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }
}
