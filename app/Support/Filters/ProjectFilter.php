<?php

namespace App\Support\Filters;

use App\Models\Project;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProjectFilter extends AbstractFilter
{
    protected string $path = Project::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
