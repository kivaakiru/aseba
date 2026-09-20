<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EventOrganizer
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (
            !$user ||
            $user->user_level !== 'user' ||
            !$user->is_event_organizer ||
            $user->status !== 'active'
        ) {
            abort(403, 'Akses Event Organizer ditolak');
        }

        return $next($request);
    }
}
