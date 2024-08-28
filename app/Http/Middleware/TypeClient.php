<?php

namespace App\Http\Middleware;

use Closure;

class TypeClient
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

        if(auth()->user()->type == 2){
            return response()->json(['status' => false , 'message' => trans('lang.no_permission')],422); 
        }
        return $next($request);
    }
}
