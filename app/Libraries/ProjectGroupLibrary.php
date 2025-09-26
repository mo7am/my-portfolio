<?php

namespace App\Libraries;

use App\Models\ProjectWork;
use App\Support\Filters\ProjectGroupFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class ProjectGroupLibrary extends AbstractLibrary
{
    protected string $model = ProjectWork::class;

    public function getProjectGroupsList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new ProjectGroupFilter($filters),
            relations: $relations
        );
    }

    public function getProjectGroupCount(array $filters = []): int
    {
        return $this->count(
            filter: new ProjectGroupFilter($filters),
        );
    }
}
