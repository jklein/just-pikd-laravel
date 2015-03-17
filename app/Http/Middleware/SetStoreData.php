<?php namespace Pikd\Http\Middleware;

use Closure;

class SetStoreData {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        \Config::set('soid', 1);
            
        return $next($request);
    }

}
