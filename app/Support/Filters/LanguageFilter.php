<?php

namespace App\Support\Filters;

use App\Models\Language;
use Illuminate\Contracts\Database\Eloquent\Builder;

class LanguageFilter extends AbstractFilter
{
    protected string $path = Language::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
