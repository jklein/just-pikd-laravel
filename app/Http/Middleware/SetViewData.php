<?php namespace Pikd\Http\Middleware;

use Closure;

class SetViewData {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
            view()->share('name', \Auth::user()->cu_first_name);
        }

        view()->share('logged_in', \Auth::check());
        view()->share('csrf_token', csrf_token());
        view()->share('config', config('view.config'));
        view()->share('flash', [
            'default' => \Session::get('default'),
            'info' => \Session::get('info'),
            'dark' => \Session::get('dark'),
            'success' => \Session::get('success'),
            'warning' => \Session::get('warning'),
            'danger' => \Session::get('danger'),
        ]);

        return $next($request);
    }
}
