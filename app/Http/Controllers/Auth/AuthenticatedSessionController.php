<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
   
    public function create()
    {
        return view('auth.login');
    }

    
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = User::where('email', $request->email)->first();

        $token = Str::random(45);

        $save_token = UserToken::create([
            'token_name' => 'user_token',
            'user_id' => $user->id,
            'token' => $token,
        ]);

        return redirect()->intended(RouteServiceProvider::HOME);

    }

    
    public function destroy(Request $request) 
    {

        $user = User::where('email', $request->user_email)->first();
        
        $user->userToken->delete();

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
