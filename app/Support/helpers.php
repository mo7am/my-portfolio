<?php

use App\Support\ContentLocale;

if (! function_exists('content_locale')) {
    /**
     * Active CV content language (independent of UI locale).
     */
    function content_locale(): string
    {
        return ContentLocale::current();
    }
}

if (! function_exists('content_locale_label')) {
    function content_locale_label(?string $locale = null): string
    {
        return ContentLocale::label($locale ?? ContentLocale::current());
    }
}
