<?php

namespace App\Support\Filters;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;

class UserFilter extends AbstractFilter
{
    protected string $path = User::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
