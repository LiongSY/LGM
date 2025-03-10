<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user has the 'staff' role
        if ($request->user() && $request->user()->role == 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
