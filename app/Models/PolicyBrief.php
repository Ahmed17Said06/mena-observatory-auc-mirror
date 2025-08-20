<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PolicyBrief extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'publish_date',
        'country_id',
        'repo_type_id',
        'data_link',
        'ar_pdf',
        'en_pdf',
        'author',
        'field',
        'subject',
        'project'
    ];

    protected $casts = [
        'publish_date' => 'date',
    ];

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

    // Use the same author_repo table as repo items
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_repo', 'policy_brief_id', 'author_id')
                    ->withTimestamps();
    }

    public function repoType()
    {
        return $this->belongsTo(Repo_type::class);
    }

    // Keep the published scope for backward compatibility
    public function scopePublished($query)
    {
        return $query->whereNotNull('publish_date');
    }
}
