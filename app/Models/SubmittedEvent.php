<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SubmittedEvent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFullSupportedMaterialAttribute(): string|null
    {
        if ($this->supported_material_link == null) {
            return null;
        }
        return Storage::disk('public')->url($this->supported_material_link);
    }
}
