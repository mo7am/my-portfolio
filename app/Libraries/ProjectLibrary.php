<?php

namespace App\Libraries;

use App\Models\Project;
use App\Support\Filters\ProjectFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectLibrary extends AbstractLibrary
{
    protected string $model = Project::class;

    public function getProjectList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new ProjectFilter($filters),
            relations: $relations
        );
    }

    public function getProjectCount(array $filters = []): int
    {
        return $this->count(
            filter: new ProjectFilter($filters),
        );
    }
}
