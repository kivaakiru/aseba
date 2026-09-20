<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (
            !Auth::check() ||
            Auth::user()->user_level === 'admin' ||
            Auth::user()->user_level === 'superadmin'
        ) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
