<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomeMiddleware
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
        if (Auth::guest()) {
            return redirect('/signIn')->with('warning', 'You have not login');
        } elseif (auth()->user() != null) {
            return $next($request);
        } else {
            return redirect('/')->with('warning', 'You have not admin access');
        }
    }
}
