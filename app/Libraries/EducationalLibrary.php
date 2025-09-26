<?php

namespace App\Libraries;

use App\Models\Educational;
use App\Support\Filters\EducationalFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class EducationalLibrary extends AbstractLibrary
{
    protected string $model = Educational::class;

    public function getEducationalList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new EducationalFilter($filters),
            relations: $relations
        );
    }

    public function getEducationalCount(array $filters = []): int
    {
        return $this->count(
            filter: new EducationalFilter($filters),
        );
    }
}
