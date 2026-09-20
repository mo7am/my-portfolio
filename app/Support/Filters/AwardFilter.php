<?php

namespace App\Support\Filters;

use App\Models\Award;
use Illuminate\Contracts\Database\Eloquent\Builder;

class AwardFilter extends AbstractFilter
{
    protected string $path = Award::class;

    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
