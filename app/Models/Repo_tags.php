<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repo_tags extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
