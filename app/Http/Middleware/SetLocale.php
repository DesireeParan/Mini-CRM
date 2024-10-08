<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (Session::has('applocale') && array_key_exists(Session::get('applocale'), config('app.locales'))) {
            App::setLocale(Session::get('applocale'));
        }
        return $next($request);
    }
}
