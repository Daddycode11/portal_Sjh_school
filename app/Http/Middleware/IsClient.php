<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsClient
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'client') {
            return $next($request);
        }

        // Optionally redirect to dashboard with error
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}
