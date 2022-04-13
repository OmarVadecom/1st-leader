<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Admin
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
        if(Auth::guest()){
            return redirect('/')->with('errorMessage', trans('error.notAllow'));
        }else{
            if(Auth::user()->isAdmin != 1){
              return redirect('/')->with('errorMessage', trans('error.notAllow'));
            }
        }
        return $next($request);
    }
}
