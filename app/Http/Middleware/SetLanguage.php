<?php

namespace App\Http\Middleware;

use Closure;

class SetLanguage
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

        $lang = $request->header('lang');
        if(!$lang){
            $lang = 'ar';
        }
        \App::setLocale($lang);
        return $next($request);
    }
}
