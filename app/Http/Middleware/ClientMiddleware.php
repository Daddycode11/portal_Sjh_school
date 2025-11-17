<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
{
    /**
     * Allow only users with user_role === 'client'
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_role === 'client') {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Access restricted to students only.');
    }
}
