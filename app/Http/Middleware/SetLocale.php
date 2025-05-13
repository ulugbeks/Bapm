<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Language;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale')) {
            $localeExists = Language::where('code', session('locale'))
                                   ->where('active', true)
                                   ->exists();
            
            if ($localeExists) {
                App::setLocale(session('locale'));
            }
        } else {
            // Set default language
            $defaultLanguage = Language::where('is_default', true)->first();
            if ($defaultLanguage) {
                App::setLocale($defaultLanguage->code);
                session(['locale' => $defaultLanguage->code]);
            }
        }

        return $next($request);
    }
}