<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->user_role == "0") {
                return redirect('/owner');
            } else if (Auth::user()->user_role == "1") {
                return redirect('/manajer');
        } else if (Auth::user()->user_role == "2") {
                return redirect('/teknisi');
            } else {
                return redirect('/kasir');
            }
        } else {
            return $next($request);
        }
    }
}
