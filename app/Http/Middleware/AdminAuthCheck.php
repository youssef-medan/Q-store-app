<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
       if (Auth::user()->role == 'admin') {
        // Auth::guard('api')->user()


        return $next($request);
       } elseif (Auth::user()->role == 'superadmin') {
        return $next($request);

       }elseif (Auth::user()->role == 'user') {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect('/dashboard');

       }

    }
}
