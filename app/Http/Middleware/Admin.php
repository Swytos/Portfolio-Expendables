<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Redirect;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role != 'Admin') {
            return abort(404);
        }

        return $next($request);
    }
}
