<?php

namespace App\Http\Middleware;

use Closure;

class VerifyActive
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
        if (!$request->user()->active) {
            \Auth::logout();
            return redirect('/login');
        }

        return $next($request);
    }
}
