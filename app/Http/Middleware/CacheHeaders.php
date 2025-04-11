<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Don't cache dynamic pages
        if (!$request->isMethod('GET')) {
            return $response;
        }
        
        // Asset caching for static files
        if (preg_match('/\.(css|js|jpg|jpeg|png|gif|ico|svg|woff|woff2)$/', $request->getRequestUri())) {
            return $response->header('Cache-Control', 'public, max-age=31536000');
        }
        
        // Default cache control for pages
        return $response->header('Cache-Control', 'max-age=0, must-revalidate, no-cache, no-store, private');
    }
}