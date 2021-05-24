<?php

namespace EcommerceApp\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userRoles = JWTAuth::user()->roles()->pluck('name');
        //dd($userRoles);
        if($userRoles[0] != "Seller")
        {
            return response("You are not a Seller");
        }
        return $next($request);
    }
}
