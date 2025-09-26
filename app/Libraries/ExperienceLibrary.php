<?php

namespace App\Libraries;

use App\Models\Experience;
use App\Support\Filters\ExperienceFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class ExperienceLibrary extends AbstractLibrary
{
    protected string $model = Experience::class;

    public function getExperienceList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new ExperienceFilter($filters),
            relations: $relations
        );
    }

    public function getExperienceCount(array $filters = []): int
    {
        return $this->count(
            filter: new ExperienceFilter($filters),
        );
    }
}
