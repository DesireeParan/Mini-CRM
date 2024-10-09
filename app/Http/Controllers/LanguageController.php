<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLang($locale)
    {
        if (array_key_exists($locale, config('app.locales'))) {
            Session::put('applocale', $locale);
            App::setLocale($locale); // Set the locale immediately for debugging
            return redirect()->back()->with('message', 'Language switched to ' . $locale);
        }
        return redirect()->back()->with('error', 'Language not supported');
    }
}
