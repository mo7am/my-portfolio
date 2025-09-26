<?php

namespace App\Libraries;

use App\Models\Tenant;
use App\Support\Filters\TenantFilter;
use Illuminate\Pagination\LengthAwarePaginator;

class TenantLibrary extends AbstractLibrary
{
    protected string $model = Tenant::class;

    public function getTenantList(array $setting, array $filters = [], array $relations = []): LengthAwarePaginator
    {
        return $this->paginated(
            setting: $setting,
            filter: new TenantFilter($filters),
            relations: $relations
        );
    }

    public function getTenantCount(array $filters = []): int
    {
        return $this->count(
            filter: new TenantFilter($filters),
        );
    }

    public function store(array $data, $tenant_id)
    {
        Tenant::where('id', $tenant_id)->update($data);
    }
}
