<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Repo extends Model
{
    use HasFactory;

//    protected $guarded=[];
    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'file',
        'publish_date',
        'country_id',
        'repo_theme_id',
        'repo_type_id',
        'ar_pdf',
        'en_pdf',
        'data_link',
        'author',
        'field',
        'subject',
        'project'
    ];

    protected $table = 'repo';

    public function country()
    {
        return $this->belongsTo(countries::class);
    }

    public function tags()
    {
        return $this->morphToMany(Repo_tags::class, 'taggable');
    }

    public function communities(): MorphToMany
    {
        return $this->morphToMany(Community::class, 'commutable');
    }

    public function pdfFiles(): HasMany
    {
        return $this->hasMany(PdfFiles::class);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}
