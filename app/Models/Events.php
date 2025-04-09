<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Events extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $fillable = ['title', 'description', 'image', 'start_date', 'end_date', 'location', 'gmaps_url', 'type', 'featured'];
    protected $dates = ['start_date', 'end_date'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_events');
    }

    public function tags()
    {
        return $this->morphToMany(Repo_tags::class, 'taggable');
    }


}
