<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PwMenaPublication extends Model
{
    use HasFactory;

    protected $table = 'pw_mena_publications';

    protected $fillable = [
        'title',
        'ar_title',
        'description',
        'content',
        'type',
        'tag',
        'link_en',
        'file_en',
        'link_ar',
        'file_ar',
        'link_fr',
        'file_fr',
        'external_link',
        'sort_order',
    ];

    // Resolve a stored path/URL to a publicly accessible URL:
    //   - "https://..."  → returned as-is (external URL)
    //   - "/docs/..."    → url(ltrim(...)) → http://domain.com/docs/...  (file in public/)
    //   - "filename.pdf" → Storage::disk('public')->url(...) → http://domain.com/storage/...
    private function resolveLink(?string $path): ?string
    {
        if (!$path) return null;
        if (Str::startsWith($path, 'http')) return $path;
        if (Str::startsWith($path, '/')) return url(ltrim($path, '/'));
        return Storage::disk('public')->url($path);
    }

    public function getLinkEnUrlAttribute(): ?string   { return $this->resolveLink($this->file_en ?? $this->link_en); }
    public function getLinkArUrlAttribute(): ?string   { return $this->resolveLink($this->file_ar ?? $this->link_ar); }
    public function getLinkFrUrlAttribute(): ?string   { return $this->resolveLink($this->file_fr ?? $this->link_fr); }
    public function getExternalUrlAttribute(): ?string { return $this->resolveLink($this->external_link); }

    public function scopeReports($query) { return $query->where('type', 'report'); }
    public function scopeBriefs($query)  { return $query->where('type', 'brief'); }
    public function scopeBlogs($query)   { return $query->where('type', 'blog'); }
}
