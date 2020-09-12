<?php

namespace App\Http\Middleware;

use Closure;

class AuthSecureKey
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
    	if($request->has('secure_key')) {
    		if($request->secure_key === config('app.secure_key')) {
			    return $next($request);
		    }
	    }

    	return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
