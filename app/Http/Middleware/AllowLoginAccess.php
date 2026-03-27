<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowLoginAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('allow_login')) {
            abort(403); // blok akses manual
        }

        return $next($request);
    }
}
