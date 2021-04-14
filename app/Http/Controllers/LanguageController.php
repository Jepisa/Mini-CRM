<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  Request  $request
     * 
     */
    public function es(Request $request){
        $request->session()->put('_language', 'es');
        return redirect()->back();
    }
    public function en(Request $request){
        
        $request->session()->put('_language', 'en');
   
        return redirect()->back();
    }
}
