<?php

if (!function_exists('cdn_asset')) {
    function cdn_asset($path) {
        if (app()->environment('production') && config('app.asset_url')) {
            return rtrim(config('app.asset_url'), '/') . '/' . ltrim($path, '/');
        }
        
        return asset($path);
    }
}

if (!function_exists('storage_url_versioned')) {
    /**
     * Public-disk URL with ?v=<file mtime>. Seeders replace images in place
     * under the same name and nginx sends no cache headers, so without the
     * version browsers keep showing the old image from their cache.
     */
    function storage_url_versioned(string $path): string
    {
        try {
            return \Illuminate\Support\Facades\Storage::url($path)
                . '?v=' . \Illuminate\Support\Facades\Storage::disk('public')->lastModified($path);
        } catch (\Throwable $e) {
            return \Illuminate\Support\Facades\Storage::url($path);
        }
    }
}
