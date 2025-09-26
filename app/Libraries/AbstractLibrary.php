<?php

namespace App\Libraries;

use App\Support\Filters\AbstractFilter;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

abstract class AbstractLibrary
{
    /**
     * holds the specific model name with its namespace.
     *
     * @var string
     */
    protected string $model;

    /**
     * holds the specific model itself.
     *
     * @var Model
     */
    protected Model $resource;

    /**
     * Create new Library class.
     *
     * this abstraction expects the child class to have a protected attribute named model.
     * that will hold the model name with its full namespace.
     */
    public function __construct()
    {
        $this->resource = app($this->model);
    }

    /**
     * get specific resource by its id.
     *
     * @param int $modelID
     * @param array $relations
     * @return Model
     */
    public function getByID(int $modelID, array $relations = []): Model
    {
        return $this->getBuilder(null, $relations)
            ->findOrFail($modelID);
    }

    /**
     * get specific resource by its id if matched specific filter.
     *
     * @param int $modelID
     * @param AbstractFilter $filter
     * @param array $relations
     * @return Model
     */
    public function getByIDIfExists(int $modelID, AbstractFilter $filter, array $relations = []): Model
    {
        return $this->getBuilder(
            filter: $filter,
            relations: $relations
        )->findOrFail($modelID);
    }

    /**
     * update by id.
     *
     * @param AbstractFilter $filter
     * @param array $data
     * @return void
     */
    public function update(AbstractFilter $filter, array $data): void
    {
        $this->getBuilder($filter)->update($data);
    }

    /**
     * delete specific resource via its id.
     *
     * @param int $modelID
     * @param bool $force
     * @return Model
     */
    public function deleteByID(int $modelID, bool $force = false): Model
    {
        $model = $this->getBuilder()->findOrFail($modelID);
        if ($force) {
            $model->forceDelete();
        }

        if (! $force) {
            $model->delete();
        }

        return $model;
    }

    /**
     * @param array $relations
     * @param array $orderBy
     * @return Collection
     */
    public function all(AbstractFilter $filter = null, $limit = null, array $relations = [], array $orderBy = [], bool $withoutGet = false): Collection|Builder
    {
        return $this->filtered(
            limit: $limit,
            filter: $filter,
            relations: $relations,
            orderBy: $orderBy,
            withoutGet: $withoutGet
        );
    }

    /**
     * save specific/new resource.
     *
     * @param array $data
     * @param Model|Authenticatable|null $model
     * @param bool $quietly
     * @return Model
     */
    public function save(array $data, Model|Authenticatable $model = null, bool $quietly = false): Model
    {
        if (! $model) {
            $model = new $this->model();
        }

        $model->fill($data);

        if ($quietly) {
            $model->saveQuietly();
        } else {
            $model->save();
        }

        return $model;
    }

    /**
     * initiate the builder.
     *
     * @param AbstractFilter|null $filter
     * @param array $relations
     * @param array $orderBy
     * @return Builder
     */
    protected function getBuilder(AbstractFilter $filter = null, array $relations = [], array $orderBy = []): Builder
    {
        $builder = $filter
            ? $filter->apply($this->resource->query())
            : $this->resource->query();

        if (! empty($orderBy)) {
            foreach ($orderBy as $key => $value) {
                $builder->orderBy($key, $value);
            }
        }

        $builder->with(Arr::get($relations, 'with', []))
            ->withCount(Arr::get($relations, 'withCount', []));

        foreach (Arr::get($relations, 'withSum', []) as $sum) {
            $builder->withSum($sum[0], $sum[1]);
        }

        return $builder;
    }

    /**
     * filter specific resources.
     *
     * @param AbstractFilter|null $filter
     * @param array $relations --> [with key is to load relations, withCount key is to count relations]
     * @param array $orderBy
     * @return Collection
     */
    protected function filtered(AbstractFilter $filter = null, $limit = null, array $relations = [], array $orderBy = [], bool $withoutGet = false): Collection|Builder
    {
        $data = $this->getBuilder($filter, $relations, $orderBy)
            ->when($limit, function ($query) use ($limit) {
                return $query->limit($limit);
            });
            
        return $withoutGet ? $data : $data->get();
    }

    /**
     * get paginated list of specific source.
     *
     * @param array $setting --> should have the keys [order, dir, offset, perPage]
     * @param AbstractFilter|null $filter
     * @param array $relations --> [with key is to load relations, withCount key is to count relations]
     * @param array $orderBy
     * @return LengthAwarePaginator
     */
    protected function paginated(array $setting = [], AbstractFilter $filter = null, array $relations = [], array $orderBy = []): LengthAwarePaginator
    {
        return $this->getBuilder($filter, $relations, $orderBy)
            ->paginate(Arr::get($setting, 'perPage', 10))->withQueryString();
    }

    /**
     * count specific resource.
     *
     * @param AbstractFilter|null $filter
     * @return int
     */
    protected function count(AbstractFilter $filter = null): int
    {
        return $this->getBuilder($filter)->count();
    }

    /**
     * get specific resource by Filter.
     *
     * @param AbstractFilter|null $filter
     * @param array $relations
     * @param bool $throwNotFound
     * @return ?Model
     */
    public function first(AbstractFilter $filter = null, array $relations = [], bool $throwNotFound = false): ?Model
    {
        $builder = $this->getBuilder($filter, $relations);

        return $throwNotFound
            ? $builder->firstOrFail()
            : $builder->first();
    }

    /**
     * get max of specific resource by its column.
     *
     * @param string $column
     * @return int
     */
    public function max(AbstractFilter $filter = null, string $column): int
    {
        return $this->getBuilder($filter)
            ->max($column);
    }
}
