<?php

namespace App\Support;

use Illuminate\Support\Facades\Request;

class ContentLocale
{
    public const SESSION_KEY = 'content_locale';

    public const COOKIE_KEY = 'content_locale';

    /**
     * Per-request override (public portfolio / PDF) — does not touch the dashboard session.
     */
    protected static ?string $requestOverride = null;

    /**
     * Resolve the active CV content locale (not the UI locale).
     */
    public static function current(): string
    {
        if (self::$requestOverride !== null && self::isSupported(self::$requestOverride)) {
            return self::$requestOverride;
        }

        $locale = session(self::SESSION_KEY);

        if (! is_string($locale) || ! self::isSupported($locale)) {
            $locale = Request::cookie(self::COOKIE_KEY, app()->getLocale());
        }

        if (! self::isSupported($locale)) {
            $locale = config('content.default', 'en');
        }

        return $locale;
    }

    /**
     * Persist CV content language for the dashboard (session).
     */
    public static function set(string $locale): void
    {
        if (! self::isSupported($locale)) {
            $locale = config('content.default', 'en');
        }

        self::$requestOverride = null;
        session([self::SESSION_KEY => $locale]);
    }

    /**
     * Temporarily use a content locale for this request only (portfolio / PDF).
     */
    public static function setForRequest(string $locale): void
    {
        if (! self::isSupported($locale)) {
            $locale = config('content.default', 'en');
        }

        self::$requestOverride = $locale;
    }

    /**
     * Default CV language to the system UI language when the user has never
     * chosen a content locale (session + cookie both empty).
     */
    public static function bootstrapDefaultFromSystem(): void
    {
        if (session()->has(self::SESSION_KEY)) {
            return;
        }

        $cookie = Request::cookie(self::COOKIE_KEY);
        if (is_string($cookie) && self::isSupported($cookie)) {
            session([self::SESSION_KEY => $cookie]);

            return;
        }

        $system = app()->getLocale();
        session([self::SESSION_KEY => self::isSupported($system) ? $system : config('content.default', 'en')]);
    }

    /**
     * On the client dashboard, show empty fields for the active content locale
     * (no fallback). On public portfolio / PDF, fall back field-by-field.
     */
    public static function shouldFallback(): bool
    {
        $path = Request::path();

        if ($path === 'client' || str_starts_with($path, 'client/')) {
            return false;
        }

        if ($path === 'admin' || str_starts_with($path, 'admin/')) {
            return false;
        }

        return true;
    }

    public static function isSupported(?string $locale): bool
    {
        return is_string($locale) && in_array($locale, self::supported(), true);
    }

    /**
     * @return list<string>
     */
    public static function supported(): array
    {
        return config('content.locales', ['en', 'ar']);
    }

    /**
     * Other locales to try when the requested one is empty.
     *
     * @return list<string>
     */
    public static function fallbacksFor(string $locale): array
    {
        return array_values(array_filter(
            self::supported(),
            fn (string $code) => $code !== $locale
        ));
    }

    public static function label(string $locale): string
    {
        return match ($locale) {
            'ar' => __('app.arabic'),
            'en' => __('app.english'),
            default => strtoupper($locale),
        };
    }
}
