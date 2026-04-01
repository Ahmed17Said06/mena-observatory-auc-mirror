<?php

if (!function_exists('cdn_asset')) {
    function cdn_asset($path) {
        if (app()->environment('production') && config('app.asset_url')) {
            return rtrim(config('app.asset_url'), '/') . '/' . ltrim($path, '/');
        }
        
        return asset($path);
    }
}