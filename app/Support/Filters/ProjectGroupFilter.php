<?php

namespace App\Support\Filters;

use App\Models\ProjectWork;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProjectGroupFilter extends AbstractFilter
{
    protected string $path = ProjectWork::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
