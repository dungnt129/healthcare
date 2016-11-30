<?php namespace App\Http\Middleware;

use App, Closure;

class CheckLogin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		// Check user session
        if (!$request->session()->has('user')) {
			return redirect()->route('login');
        }

        return $next($request);
    }

}
