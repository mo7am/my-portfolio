<?php

namespace App\Models\Concerns;

use App\Support\ContentLocale;

trait HasTranslations
{
    /**
     * @return list<string>
     */
    public function getTranslatable(): array
    {
        return property_exists($this, 'translatable')
            ? $this->translatable
            : [];
    }

    public function isTranslatableAttribute(string $key): bool
    {
        return in_array($key, $this->getTranslatable(), true);
    }

    public function getAttribute($key): mixed
    {
        if (! $key || ! $this->isTranslatableAttribute($key)) {
            return parent::getAttribute($key);
        }

        return $this->getTranslation(
            $key,
            ContentLocale::current(),
            ContentLocale::shouldFallback()
        );
    }

    public function setAttribute($key, $value): mixed
    {
        if (! $this->isTranslatableAttribute($key)) {
            return parent::setAttribute($key, $value);
        }

        // Full locale map assigned (e.g. from migration / seeder).
        if (is_array($value) && $this->looksLikeLocaleMap($value)) {
            $this->attributes[$key] = $this->encodeTranslations($value);

            return $this;
        }

        return $this->setTranslation($key, ContentLocale::current(), $value);
    }

    public function getTranslation(string $key, ?string $locale = null, bool $useFallback = true): mixed
    {
        $locale ??= ContentLocale::current();
        $translations = $this->getTranslations($key);
        $value = $translations[$locale] ?? null;

        if ($this->isEmptyTranslation($value) && $useFallback) {
            foreach (ContentLocale::fallbacksFor($locale) as $fallback) {
                $candidate = $translations[$fallback] ?? null;
                if (! $this->isEmptyTranslation($candidate)) {
                    return $candidate;
                }
            }
        }

        return $value ?? $this->emptyValueFor($key);
    }

    /**
     * @return array<string, mixed>
     */
    public function getTranslations(string $key): array
    {
        if (! array_key_exists($key, $this->attributes) || $this->attributes[$key] === null || $this->attributes[$key] === '') {
            return [];
        }

        $raw = $this->attributes[$key];

        if (is_array($raw)) {
            return $this->normalizeLegacyTags($key, $raw);
        }

        if (! is_string($raw)) {
            return [];
        }

        $decoded = json_decode($raw, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $this->normalizeLegacyTags($key, $decoded);
        }

        // Plain legacy string → treat as English (and keep readable via fallback).
        return ['en' => $raw];
    }

    public function setTranslation(string $key, string $locale, mixed $value): static
    {
        if (! ContentLocale::isSupported($locale)) {
            $locale = ContentLocale::current();
        }

        $translations = $this->getTranslations($key);
        $translations[$locale] = $value;
        $this->attributes[$key] = $this->encodeTranslations($translations);

        return $this;
    }

    public function forgetTranslation(string $key, string $locale): static
    {
        $translations = $this->getTranslations($key);
        unset($translations[$locale]);
        $this->attributes[$key] = $this->encodeTranslations($translations);

        return $this;
    }

    /**
     * True when the model has non-empty content for any translatable field in $locale.
     */
    public function hasContentInLocale(string $locale): bool
    {
        foreach ($this->getTranslatable() as $key) {
            if (! $this->isEmptyTranslation($this->getTranslation($key, $locale, false))) {
                return true;
            }
        }

        return false;
    }

    protected function encodeTranslations(array $translations): string
    {
        return json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?: '{}';
    }

    protected function looksLikeLocaleMap(array $value): bool
    {
        if ($value === [] || array_is_list($value)) {
            return false;
        }

        $locales = ContentLocale::supported();

        foreach (array_keys($value) as $key) {
            if (! in_array($key, $locales, true)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Legacy tags were a flat JSON list: ["php","laravel"].
     * New shape: {"en":["php"],"ar":["php"]}.
     *
     * @param  array<int|string, mixed>  $decoded
     * @return array<string, mixed>
     */
    protected function normalizeLegacyTags(string $key, array $decoded): array
    {
        if ($key === 'tags' && array_is_list($decoded)) {
            return ['en' => $decoded];
        }

        return $decoded;
    }

    protected function isEmptyTranslation(mixed $value): bool
    {
        if ($value === null) {
            return true;
        }

        if (is_string($value)) {
            return trim($value) === '';
        }

        if (is_array($value)) {
            return count(array_filter($value, fn ($item) => ! $this->isEmptyTranslation($item))) === 0;
        }

        return false;
    }

    protected function emptyValueFor(string $key): mixed
    {
        return $key === 'tags' ? [] : null;
    }

    /**
     * Ensure toArray / DataTables JSON returns resolved values for the active content locale.
     *
     * @return array<string, mixed>
     */
    public function attributesToArray(): array
    {
        $attributes = parent::attributesToArray();

        foreach ($this->getTranslatable() as $key) {
            if (array_key_exists($key, $attributes)) {
                $attributes[$key] = $this->getTranslation(
                    $key,
                    ContentLocale::current(),
                    ContentLocale::shouldFallback()
                );
            }
        }

        return $attributes;
    }
}
