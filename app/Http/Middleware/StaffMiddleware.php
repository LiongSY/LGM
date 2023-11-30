<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->hasRole('staff')) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
