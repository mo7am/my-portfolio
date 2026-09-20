<?php

namespace App\Http\Controllers;

use App\Support\ContentLocale;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContentLocaleController extends Controller
{
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        if (! ContentLocale::isSupported($locale)) {
            $locale = config('content.default', 'en');
        }

        ContentLocale::set($locale);

        return back()->withCookie(cookie()->forever(ContentLocale::COOKIE_KEY, $locale));
    }
}
