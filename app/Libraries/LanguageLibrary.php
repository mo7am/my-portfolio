<?php

namespace App\Libraries;

use App\Models\Language;
use App\Support\Filters\LanguageFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class LanguageLibrary extends AbstractLibrary
{
    protected string $model = Language::class;

    public function getExperienceList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new LanguageFilter($filters),
            relations: $relations
        );
    }

    public function getLanguageCount(array $filters = []): int
    {
        return $this->count(
            filter: new LanguageFilter($filters),
        );
    }
}
