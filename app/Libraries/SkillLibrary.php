<?php

namespace App\Libraries;

use App\Models\Skill;
use App\Support\Filters\SkillFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class SkillLibrary extends AbstractLibrary
{
    protected string $model = Skill::class;

    public function getExperienceList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new SkillFilter($filters),
            relations: $relations
        );
    }

    public function getSkillCount(array $filters = []): int
    {
        return $this->count(
            filter: new SkillFilter($filters),
        );
    }
}
