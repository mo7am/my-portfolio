<?php

namespace App\Support\Filters;

use App\Models\Link;
use Illuminate\Contracts\Database\Eloquent\Builder;

class LinkFilter extends AbstractFilter
{
    protected string $path = Link::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
