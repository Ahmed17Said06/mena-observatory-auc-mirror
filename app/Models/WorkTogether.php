<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WorkTogether extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFullUrlCVAttribute(): string
    {
        return Storage::disk('public')->url($this->cv_link);
    }
    public function getFullUrlCollaborationAttribute(): string
    {
        return Storage::disk('public')->url($this->collaboration_link);
    }
}
