<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // If user is not logged in, redirect to login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // If user's role does not match the required role
        if (Auth::user()->user_role !== $role) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
