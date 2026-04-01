<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repo_theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'repo_theme';
}
