<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use App\Models\Concerns\Publishable;
use App\Models\Concerns\Sortable;
use App\Support\ContentLocale;
use Illuminate\Database\Eloquent\Model;

class LandingPlan extends Model
{
    use HasTranslations, Publishable, Sortable;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'name',
        'description',
        'badge',
        'cta_label',
        'period_label',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'badge',
        'cta_label',
        'period_label',
        'features',
        'price_monthly',
        'currency',
        'is_highlighted',
        'cta_route',
        'cta_params',
        'billing_plan_id',
        'sort_order',
        'is_published',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'cta_params' => 'array',
            'price_monthly' => 'float',
            'is_highlighted' => 'boolean',
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    /**
     * @return list<string>
     */
    public function featuresForLocale(?string $locale = null): array
    {
        $locale ??= ContentLocale::current();
        $all = is_array($this->features) ? $this->features : [];
        $items = $all[$locale] ?? null;

        if ((! is_array($items) || $items === []) && ContentLocale::shouldFallback()) {
            foreach (ContentLocale::fallbacksFor($locale) as $fallback) {
                $candidate = $all[$fallback] ?? null;
                if (is_array($candidate) && $candidate !== []) {
                    $items = $candidate;
                    break;
                }
            }
        }

        if (! is_array($items)) {
            return [];
        }

        return array_values(array_filter(array_map(
            fn ($item) => is_string($item) ? trim($item) : '',
            $items
        )));
    }

    public function featuresTextForLocale(?string $locale = null): string
    {
        return implode("\n", $this->featuresForLocale($locale));
    }

    /**
     * @param  list<string>|string  $features
     */
    public function setFeaturesForLocale(string $locale, array|string $features): void
    {
        if (is_string($features)) {
            $features = preg_split('/\r\n|\r|\n/', $features) ?: [];
        }

        $features = array_values(array_filter(array_map(
            fn ($item) => is_string($item) ? trim($item) : '',
            $features
        )));

        $all = is_array($this->features) ? $this->features : [];
        $all[$locale] = $features;
        $this->features = $all;
    }

    public function ctaUrl(): string
    {
        $route = $this->cta_route ?: 'register';
        $params = is_array($this->cta_params) ? $this->cta_params : [];

        try {
            return route($route, $params);
        } catch (\Throwable) {
            return route('register', ['plan' => $this->code]);
        }
    }
}
