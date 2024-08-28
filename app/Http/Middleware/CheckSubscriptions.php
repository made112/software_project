<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;

class CheckSubscriptions
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

        $setting = Setting::first();
        if(date('Y-m-d') >= $setting->to){
            return redirect('/admin/dashboard');
        }
        return $next($request);
    }
}
