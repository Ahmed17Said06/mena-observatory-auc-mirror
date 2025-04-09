<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Community extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function interests(): BelongsToMany
    {
        return $this->belongsToMany(Interests::class, 'community_interest',
            'community_id', 'interest_id');
    }


    public function news()
    {
        return $this->morphedByMany(News::class, 'commutable');
    }

    public function repos()
    {
        return $this->morphedByMany(Repo::class, 'commutable');
    }


//    public function scopeInfo($query)
//    {
//        return $query->with('team1', 'team2');
//    }
}
