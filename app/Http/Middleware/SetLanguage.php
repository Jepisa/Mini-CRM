<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use \Illuminate\Http\Request;

use Closure;
use Illuminate\Support\Facades\App;

class SetLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::get('_language'));
        {
            // Str::replaceLast('?en', '', Session::get('url'));
            $language = Session::get('_language');
            App::setLocale($language);
            
        }
        return $next($request);
    }
}
