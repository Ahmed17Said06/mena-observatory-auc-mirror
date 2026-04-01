<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Interests extends Model
{
    use HasFactory;


    protected $fillable = ['name'];

    public function communities(): BelongsToMany
    {
        return $this->belongsToMany(Community::class, 'community_interest',
            'interest_id', 'community_id');
    }
}
