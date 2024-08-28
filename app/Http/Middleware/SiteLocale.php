<?php

namespace App\Http\Middleware;

use Closure;

class Sitelocale
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
        if($request->segment(1)){
            $lang = $request->segment(1);
        }else{
            $lang = 'ar';
        }
        app()->setLocale($lang);
        return $next($request);
    }
}
