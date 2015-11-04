<?php

namespace App\Http\Middleware;

use Closure;

class ACLMiddleware
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
		 	if (array_key_exists('_branch',$loggeduser->permissions)){
				 return redirect('contracts');
			}
			elseif(array_key_exists('_account',$loggeduser->permissions)) {
				return redirect('contracts');
			}
			else{
				return redirect('login');
			}
		 }  
		 else { return redirect('login');}
    }
}
