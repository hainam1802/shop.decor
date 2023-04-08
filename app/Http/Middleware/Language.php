<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Closure;

class Language
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
        if(Session::has('locale')){
                    //    dd(Session::has('locale'));
            app()->setLocale(Session::get('locale'));
                    //    dd(app()->getLocale());
        }
        return $next($request);
    }
}
