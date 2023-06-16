<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isSeller
{
   
    public function handle(Request $request, Closure $next)
    {
        //is the autheneticated user a seller
        if(Auth::check())
        {
            if(Auth::user()->userType)
            {
                if(Auth()->user()->userType->name == 'Vendeur' OR Auth()->user()->userType->name == 'Administrateur' ){
                    return $next($request);
                }else{
                    abort(403);
                }
            }
        }
    }
}
