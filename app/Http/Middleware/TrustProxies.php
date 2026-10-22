<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * Trust whatever TRUSTED_PROXIES names, and nothing when it is unset.
     *
     * Needed whenever the app is reached through a proxy: without it Laravel
     * ignores X-Forwarded-Proto, treats the request as plain HTTP, and logs
     * the proxy's address as the visitor's.
     */
    public function __construct()
    {
        $value = config('app.trusted_proxies');

        if (is_string($value) && trim($value) !== '') {
            $this->proxies = trim($value) === '*'
                ? '*'
                : array_values(array_filter(array_map('trim', explode(',', $value))));
        }
    }

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
