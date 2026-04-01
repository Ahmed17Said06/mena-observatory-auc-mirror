<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brochure extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'ar_title', 'slug', 'description', 'ar_description',
        'content', 'ar_content', 'image', 'pdf_file', 'is_published',
    ];
}
