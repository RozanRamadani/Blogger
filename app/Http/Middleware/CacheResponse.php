<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $minutes = 60): Response
    {
        // Only cache GET requests
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        // Don't cache authenticated user requests
        if ($request->user()) {
            return $next($request);
        }

        $key = 'route:' . md5($request->fullUrl());

        // Check if cached response exists
        if (cache()->has($key)) {
            return cache()->get($key);
        }

        $response = $next($request);

        // Only cache successful responses
        if ($response->getStatusCode() === 200) {
            cache()->put($key, $response, now()->addMinutes($minutes));
        }

        return $response;
    }
}
