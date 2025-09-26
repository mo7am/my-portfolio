<?php

namespace App\Support\Filters;

use App\Models\Skill;
use Illuminate\Contracts\Database\Eloquent\Builder;

class SkillFilter extends AbstractFilter
{
    protected string $path = Skill::class;

    /**
     * @inheritDoc
     */
    protected function filter_build(Builder $builder): Builder
    {
        return $builder;
    }
}
