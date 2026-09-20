<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        if (! in_array($locale, ['en', 'ar'], true)) {
            $locale = 'en';
        }

        session(['locale' => $locale]);

        return back()->withCookie(cookie()->forever('locale', $locale));
    }
}
