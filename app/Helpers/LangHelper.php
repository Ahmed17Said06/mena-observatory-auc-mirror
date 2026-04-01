<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (!function_exists('getLang')) {
    function getLang(): string
    {
        return LaravelLocalization::getCurrentLocale();
    }
}
