<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Storage;

class NewWorkBlog extends Model
{
    use HasFactory;

    protected $table = 'new_work_blogs';

    protected $fillable = [
        "title",
        "description",
        "content",
        'image',
        'publish_date',
        'country_id',
        'views'
    ];

    protected $casts = [
        'publish_date' => 'date',
    ];

    public function tags()
    {
        return $this->morphToMany(Repo_tags::class, 'taggable');
    }

    public function communities(): MorphToMany
    {
        return $this->morphToMany(Community::class, 'commutable');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_new_work_blogs');
    }

    public function country()
    {
        return $this->belongsTo(countries::class, 'country_id');
    }

    public function scopePublished($query)
    {
        return $query->where('publish_date', '<=', now());
    }
}