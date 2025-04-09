<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SubmittedWork extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFullUrlCVAttribute(): string
    {
        return Storage::disk('public')->url($this->cv_link);
    }
    public function getFullUrlProjectAttribute(): string
    {
        return Storage::disk('public')->url($this->projects_link);
    }
}
