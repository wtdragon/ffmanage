<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
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
    	$loggeduser=\App::make('authenticator')->getLoggedUser();	
    	$authentication = \App::make('authentication_helper');
		if($loggeduser) 
		 {
		 	return $next($request);
		 }
		 
			return redirect('login');
		 
        
    }
}
