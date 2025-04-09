<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class static_content extends Model
{
    use HasFactory;

    protected $table = 'statics';

    protected $fillable = ['key', 'content', 'ar_content','media', 'width', 'height', 'has_media', 'page'];
}
