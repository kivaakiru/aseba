<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperAdmin
{
    public function handle($request, Closure $next)
    {
        if (
            auth()->check() &&
            auth()->user()->email === config('aseba.super_admin_email')
        ) {
            return $next($request);
        }

        abort(403);
    }
}
