<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Storage;

class Blogs extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "content",
        'image',
        'publish_date',
        'country_id',
        'views'
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
        return $this->belongsToMany(User::class, 'user_blogs');
    }

//    protected static function boot(): void
//    {
//        parent::boot();
//
//        /** @var Model $model */
//        static::updating(function ($model) {
//            if ($model->isDirty('image') && ($model->getOriginal('image') !== null)) {
//                Storage::disk('public')->delete($model->getOriginal('image'));
//            }
//        });
//    }
}
