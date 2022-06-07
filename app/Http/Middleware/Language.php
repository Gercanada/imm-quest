<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (session('applocate')) {
            $configLanguaje = config('languajes')[session('applocate')];
            setlocale(LC_TIME, $configLanguaje[1] . 'utf8');
            Carbon::setLocale(session('applocate'));
            App::setLocale(session('applocate'));
        } else {
            session()->put('applocate', config('app.fallback_locale'));
            setlocale(LC_TIME, 'es_ES.utf8');
            Carbon::setLocale(session('applocate'));
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}
