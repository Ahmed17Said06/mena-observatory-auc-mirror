<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalResource extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tags()
    {
        return $this->morphToMany(Repo_tags::class, 'taggable');
    }

    public function country()
    {
        return $this->belongsTo(countries::class);
    }
}
