<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class Localization
{
    const SESSION_KEY = 'locale';

    public function handle($request, Closure $next)
    {
        $locales = env('LOCALES');
        $session = $request->getSession();
        if (!$session->has(self::SESSION_KEY)) {
            $session->put(self::SESSION_KEY, $request->getPreferredLanguage($locales));
        }

        if ($request->has('lang')) {
            $lang = $request->get('lang');
            if (in_array($lang, $locales)) {
                $session->put(self::SESSION_KEY, $lang);
            }
        }

        if ($session->has('locale')) {
            App::setlocale($session->get('locale'));
        }
        return $next($request);
    }
}
