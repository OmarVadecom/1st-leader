<?php

namespace App\Http\Middleware;

use Closure;

class CheckClosed
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
        if(getSettings('website_status', true) != 1){
            return redirect(route('site.closed'));
        }
        return $next($request);
    }
}
