<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{

    //handle selected language by the user
    public function changeLanguage(Request $request)
    {
        $language = $request->lang;

        App::setLocale($language);

        //put the language value in a session
        session()->put('locale', $language);
  
        return redirect()->back();
    }
}
