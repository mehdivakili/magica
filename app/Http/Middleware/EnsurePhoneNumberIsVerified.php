<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class EnsurePhoneNumberIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!$request->user()->phone_number_verified){
            return route('phone_number_verification');
        }

        return $next($request);
    }
}
