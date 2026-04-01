<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // add other fillable fields as needed
    ];

    // Existing relationship with repo items
    public function repos(): BelongsToMany
    {
        return $this->belongsToMany(Repo::class, 'author_repo', 'author_id', 'repo_id')
                    ->withTimestamps();
    }

    // New relationship with policy briefs using the same table
    public function policyBriefs(): BelongsToMany
    {
        return $this->belongsToMany(PolicyBrief::class, 'author_repo', 'author_id', 'policy_brief_id')
                    ->withTimestamps();
    }

    // Combined relationship to get all authored content
    public function getAllContent()
    {
        return collect()
            ->merge($this->repos)
            ->merge($this->policyBriefs);
    }
}
