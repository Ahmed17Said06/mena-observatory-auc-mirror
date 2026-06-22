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
