<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class Lang
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

        if(Session::has('local')){
            // dd(Session::get('local'));

            //here the local will actully change
            app()->setLocale(Session::get('local'));
        }

        return $next($request);
    }
}
