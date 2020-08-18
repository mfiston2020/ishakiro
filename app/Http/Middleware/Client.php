<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Client
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }
        if(Auth::user()->role == 'client')
        {
            return $next($request);
        }
        if(Auth::user()->role == 'agent')
        {
            return redirect()->route('agent');
        }
        if(Auth::user()->role == 'admin')
        {
            return redirect()->route('home');
        }
    }
}
