<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class News extends Model
{
    use HasFactory;
    public function tags()
    {
        return $this->morphToMany(Repo_tags::class, 'taggable');
    }

    public function communities(): MorphToMany
    {
        return $this->morphToMany(Community::class, 'commutable');
    }
    protected $fillable = ['title', 'content', 'date', 'description', 'image', 'featured', 'country_id'];
}
