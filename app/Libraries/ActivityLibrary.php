<?php

namespace App\Libraries;

use App\Models\Activity;
use App\Support\Filters\ActivityFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityLibrary extends AbstractLibrary
{
    protected string $model = Activity::class;

    public function getActivityList(array $setting, array $filters = [], array $relations = [], array $orderBy = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new ActivityFilter($filters),
            relations: $relations,
            orderBy: $orderBy
        );
    }

    public function getActivityCount(array $filters = []): int
    {
        return $this->count(
            filter: new ActivityFilter($filters),
        );
    }
}
