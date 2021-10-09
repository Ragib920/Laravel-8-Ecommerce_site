<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
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
        if(session('user_type')==='ADM')
        {
            return $next($request);
        }
        else
        {
            session()->flash();
            return redirect()->route('login');
        }
        return $next($request);
    }
}
