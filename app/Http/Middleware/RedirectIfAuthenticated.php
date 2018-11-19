<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::user()->groups()->where('group_id',2)->count())
                return redirect('advisors/profile');
            else {
                if(($_SERVER['SERVER_NAME'] == 'dev.netver.com' || $_SERVER['SERVER_NAME'] == 'www.netver.com') && !Auth::user()->groups()->where('group_id',2)->count()) {
                    Auth::guard()->logout();
                    return redirect()->route('login')->with('status','Invalid User!');
                }
                else
                    return redirect('home');
            }
        }

        return $next($request);
    }
}
