<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminAccess
{
    public function handle($request, Closure $next) 
    {
        if (Auth::check() && Auth::user()->access_level > 8) {
            return $next($request);
        }

        abort(404);
    } 
}
