<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'project',
        'is_our_work',
        'is_global',
        'is_research',
        'is_talk_webinar',
        'is_educational',
    ];

    protected $casts = [
        'is_our_work' => 'boolean',
        'is_global' => 'boolean',
        'is_research' => 'boolean',
        'is_talk_webinar' => 'boolean',
        'is_educational' => 'boolean',
    ];

    protected $table = 'repo';

    public function country()
    {
        return $this->belongsTo(countries::class);
    }

    public function repoType()
    {
        return $this->belongsTo(Repo_type::class, 'repo_type_id');
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
