<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OrganizerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'organizer') {
            return $next($request);
        }

        return redirect()->route('login');
    }
}