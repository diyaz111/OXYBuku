<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    public function handle(Request $request, Closure $next, $isAdmin)
    {
        if (auth()->user()->role != $isAdmin) {
            abort(403, 'You are not authorized to access this route');
        }

        return $next($request);
    }
}
