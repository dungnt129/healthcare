<?php namespace App\Http\Middleware;

use App, Closure;

class CheckAdmin
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

		$user = session('user');

		// Check user is not admin
		if($user[3] != 1) {
			return redirect()->route('login');
		}

        return $next($request);
    }

}
