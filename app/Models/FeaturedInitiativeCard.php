<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedInitiativeCard extends Model
{
    protected $fillable = [
        'label_en', 'label_ar',
        'sub_label_en', 'sub_label_ar',
        'image',
        'title_en', 'title_ar',
        'link', 'link_external',
        'button_text_en', 'button_text_ar',
        'button_icon',
        'sort_order', 'is_active',
    ];

    protected $casts = [
        'link_external' => 'boolean',
        'is_active'     => 'boolean',
    ];
}
