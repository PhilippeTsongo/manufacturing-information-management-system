<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isComptable
{
    
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            if(Auth()->user()->userType)
            {
                if(Auth()->user()->userType->name == 'Comptable' OR Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Financier' OR
                Auth()->user()->userType->name == 'Entrepreneur'){
                    return $next($request);
                }else{
                    abort(403);
                }
            }
        }
    }
}
