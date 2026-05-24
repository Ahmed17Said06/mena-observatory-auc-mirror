<?php

namespace App\Filament\Concerns;

use App\Models\static_content;

trait SavesStaticContent
{
    protected function saveKey(string $key, mixed $value): void
    {
        static_content::where('key', $key)->delete();
        static_content::create([
            'key'       => $key,
            'content'   => (string) $value,
            'page'      => 'global',
            'has_media' => 'no',
        ]);
    }

    protected function getVal(string $key, string $default = ''): string
    {
        return strip_tags(static_content::where('key', $key)->latest()->value('content') ?? $default);
    }

    protected function getRichVal(string $key, string $default = ''): string
    {
        return static_content::where('key', $key)->latest()->value('content') ?? $default;
    }

    protected function saveKeyBilingual(string $key, string $en, string $ar): void
    {
        static_content::where('key', $key)->delete();
        static_content::create([
            'key'        => $key,
            'content'    => $en,
            'ar_content' => $ar,
            'page'       => 'global',
            'has_media'  => 'no',
        ]);
    }

    protected function getArVal(string $key, string $default = ''): string
    {
        return strip_tags(static_content::where('key', $key)->latest()->value('ar_content') ?? $default);
    }
}
