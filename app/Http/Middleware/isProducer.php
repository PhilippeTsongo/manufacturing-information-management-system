<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isProducer
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth()->user()->userType)
            {
                if(Auth()->user()->userType->name == 'Producteur' OR Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Financier'){
                    return $next($request);
                }else{
                    abort(403);
                }
            }
        }
    }
}
