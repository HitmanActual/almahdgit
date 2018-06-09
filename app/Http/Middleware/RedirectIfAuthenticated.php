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
        switch($guard){

            case 'pediatric':
            if(Auth::guard($guard)->check()){
                return redirect()->route('pediatric.dashboard');
            }
            break;

            case 'orthopedic':
            if(Auth::guard($guard)->check()){
                return redirect()->route('orthopedic.dashboard');
            }
            break;

            default:
            if(Auth::guard($guard)->check()){
                return redirect()->route('physician.login');
            }
            break;

        }
        
        /*if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }*/

        return $next($request);
    }
}
