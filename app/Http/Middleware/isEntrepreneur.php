<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isEntrepreneur
{
    
    public function handle(Request $request, Closure $next)
    {
        //Check if the user is an manager
        if(Auth()->check())
        {
            if(Auth()->user()->userType)
            {
                if(Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Administrateur')
                {
                    return $next($request);
                }else{
                    abort(403);
                }
            }
        }
    }
}
