<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiUserAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::guard('api')->user()->role == 'user'){
            return $next($request);



           } elseif (Auth::guard('api')->user()->role == 'superadmin') {



                auth('api')->logout();
                return response()->json(['msg'=>'Not Allowed']);








           }elseif (Auth::guard('api')->user()->role == 'admin') {


                auth('api')->logout();
                return response()->json(['msg'=>'Not Allowed']);



           }else {


                auth('api')->logout();
                return response()->json(['msg'=>'Not Allowed']);


           }

    }
}
