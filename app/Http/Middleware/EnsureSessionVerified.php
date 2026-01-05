<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSessionVerified
{
    /**
     * Handle an incoming request.
     * If the session does not contain a valid verification timestamp, redirect to verify page.
     */
    public function handle(Request $request, Closure $next)
    {
        $now = time();

        // Allow access to the verify route itself to prevent redirect loop
        if ($request->routeIs('verify')) {
            return $next($request);
        }

        $validUntil = session('verification_valid_until', 0);

        if ($validUntil && $validUntil > $now) {
            return $next($request);
        }

        return redirect()->route('verify');
    }
}
