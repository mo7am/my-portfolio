<?php

namespace App\Libraries;

use App\Models\LandingPlan;

class LandingPlanLibrary extends AbstractLibrary
{
    protected string $model = LandingPlan::class;

    public function nextSortOrder(): int
    {
        return ((int) $this->resource->newQuery()->max('sort_order')) + 1;
    }
}
