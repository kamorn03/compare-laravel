<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            if(str_contains(request()->URL(), 'blogger')){
                Auth::logout();
                Session::flush();
                if (Auth::guard('blogger')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                    return redirect()->intended('/');
                }
            }
            return redirect('/digiso-admin');
        }
        if ($guard == "blogger" && Auth::guard($guard)->check()) {
            return redirect('/');
        }
        // current
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        return $next($request);
    }
}
