<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (!function_exists('getLang')) {
    function getLang(): string
    {
        return LaravelLocalization::getCurrentLocale();
    }
}

if (!function_exists('tr')) {
    /**
     * Inline bilingual helper for hardcoded page strings: returns the Arabic
     * text when the current locale is Arabic, otherwise the English source.
     * Use {{ tr('English', 'عربية') }} for plain text and
     * {!! tr('<b>English</b>', '<b>عربية</b>') !!} when the value contains HTML.
     */
    function tr(string $en, string $ar): string
    {
        return LaravelLocalization::getCurrentLocale() === 'ar' ? $ar : $en;
    }
}

if (!function_exists('countryLabel')) {
    /**
     * Normalise a country/region tag and localise it. Fixes casing (e.g.
     * "lebanon" → "Lebanon") in English and returns the Arabic name when the
     * locale is Arabic. Unknown values are returned title-cased as-is.
     */
    function countryLabel(?string $tag): string
    {
        $key = strtolower(trim((string) $tag));
        if ($key === '') {
            return '';
        }

        $map = [
            'egypt'     => 'مصر',
            'jordan'    => 'الأردن',
            'lebanon'   => 'لبنان',
            'morocco'   => 'المغرب',
            'tunisia'   => 'تونس',
            'palestine' => 'فلسطين',
            'mena'      => 'الشرق الأوسط وشمال أفريقيا',
        ];

        $isAr = LaravelLocalization::getCurrentLocale() === 'ar';
        if ($isAr && isset($map[$key])) {
            return $map[$key];
        }

        // English (or unknown): tidy the casing. Keep acronyms like MENA upper.
        return $key === 'mena' ? 'MENA' : ucwords($key);
    }
}
