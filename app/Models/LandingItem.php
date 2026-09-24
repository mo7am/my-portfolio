<?php

namespace App\Models;

use App\Enums\LandingItemType;
use App\Models\Concerns\HasTranslations;
use App\Models\Concerns\Publishable;
use App\Models\Concerns\Sortable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LandingItem extends Model
{
    use HasTranslations, Publishable, Sortable;

    /**
     * @var list<string>
     */
    public array $translatable = [
        'title',
        'body',
    ];

    /**
     * @var list<string>
     */
    protected $fillable = [
        'type',
        'title',
        'body',
        'icon',
        'meta',
        'sort_order',
        'is_published',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => LandingItemType::class,
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }

    public function scopeOfType(Builder $query, LandingItemType|string $type): Builder
    {
        $value = $type instanceof LandingItemType ? $type->value : $type;

        return $query->where($this->getTable().'.type', $value);
    }
}
