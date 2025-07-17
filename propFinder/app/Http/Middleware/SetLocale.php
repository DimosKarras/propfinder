<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');
        if (!empty($locale) && in_array($locale, ['en', 'el'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }

}
