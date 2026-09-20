<?php

use App\Support\ContentLocale;
use ArPHP\I18N\Arabic;

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

if (! function_exists('pdf_text')) {
    /**
     * Shape Arabic for DomPDF (connects letters + correct visual order).
     * DomPDF cannot do Arabic shaping natively.
     */
    function pdf_text(mixed $text): string
    {
        if ($text === null) {
            return '';
        }

        $text = (string) $text;

        if ($text === '' || app()->getLocale() !== 'ar') {
            return $text;
        }

        if (! preg_match('/\p{Arabic}/u', $text)) {
            return $text;
        }

        static $arabic = null;
        $arabic ??= new Arabic;

        return $arabic->utf8Glyphs($text);
    }
}

if (! function_exists('pdf_date')) {
    /**
     * Format a date for DomPDF. Shapes Arabic month names without rearranging day/year.
     */
    function pdf_date(mixed $date, string $format = 'j F Y'): string
    {
        if ($date === null || $date === '') {
            return '';
        }

        $carbon = \Carbon\Carbon::parse($date)->locale(app()->getLocale());

        if (app()->getLocale() !== 'ar') {
            return $carbon->translatedFormat($format);
        }

        // utf8Glyphs() on a full "1 يونيو 1996" string breaks number order — shape month only.
        $day = $carbon->format('j');
        $year = $carbon->format('Y');
        $month = pdf_text($carbon->translatedFormat('F'));

        return $day.' '.$month.' '.$year;
    }
}

if (! function_exists('marital_status_label')) {
    /**
     * Localized marital status label (DB stores English enum values).
     */
    function marital_status_label(?string $status): string
    {
        if ($status === null || $status === '') {
            return '';
        }

        $key = 'cv.marital.'.$status;

        return __($key) !== $key ? __($key) : $status;
    }
}
