<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PdfFiles extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function repo(): BelongsTo
    {
        return $this->belongsTo(Repo::class);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($pdfFile) {
            $repo = $pdfFile->repo;
            $pdfFilesCount = $repo->pdfFiles()->count();

            if ($pdfFilesCount >= 3) {
                return false;
            }
        });
    }
}
