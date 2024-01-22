<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , string  $guard): Response
    {

        if (empty(Auth::guard($guard)->user())) {
            // Auth::guard('api')->user()


            return $next($request);

        }elseif(Auth::guard($guard)->user()->role == 'user'){
            return $next($request);



           } elseif (Auth::guard($guard)->user()->role == 'superadmin') {

            if ($guard == 'api') {

                auth('api')->logout();
                return response()->json(['msg'=>'Not Allowed']);
            }


            Auth::guard($guard)->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();



            return to_route('weblogin')->with('status','user not found');

           }elseif (Auth::guard($guard)->user()->role == 'admin') {
            if ($guard == 'api') {

                auth('api')->logout();
                return response()->json(['msg'=>'Not Allowed']);
            }

            Auth::guard($guard)->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return to_route('weblogin')->with('status','user not found');

           }else {

            if ($guard == 'api') {

                auth('api')->logout();
                return response()->json(['msg'=>'Not Allowed']);
            }
            Auth::guard($guard)->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            auth('api')->logout();


           }

    }
}
