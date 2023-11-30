<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffOrAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && ($request->user()->role == 'staff' || $request->user()->role == 'admin')) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
