<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OrganizerApprovalMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->type === 'organizer' && auth()->user()->approval_status === 'approved') {
            return $next($request);
        }

        return redirect()->route('organizer.pending');
    }
}