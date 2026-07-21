<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetRequestLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->input('lang')
            ?: $request->header('X-Locale')
            ?: substr((string) $request->getPreferredLanguage(['vi', 'en']), 0, 2);

        App::setLocale(in_array($locale, ['vi', 'en'], true) ? $locale : 'vi');

        return $next($request);
    }
}
