<?php

namespace App\Libraries;

use App\Models\User;
use App\Support\Filters\UserFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class UserLibrary extends AbstractLibrary
{
    protected string $model = User::class;

    public function getUserList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new UserFilter($filters),
            relations: $relations
        );
    }

    public function getUserCount(array $filters = []): int
    {
        return $this->count(
            filter: new UserFilter($filters),
        );
    }
}
