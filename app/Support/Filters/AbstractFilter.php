<?php

namespace App\Support\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

abstract class AbstractFilter
{
    /**
     * keys we'll build the query depending on them.
     *
     * @var array
     */
    protected array $filters;

    /**
     * The model class with namespace.
     *
     * @var string
     */
    protected string $path;

    /**
     * The model object.
     *
     * @var Model|mixed
     */
    protected Model $model;

    /**
     * keys already used.
     *
     * @var array
     */
    protected array $used = [];

    /**
     * AbstractFilters constructor.
     *
     * @param array $filters
     */
    public function __construct(array $filters)
    {
        $this->filters = $filters;

        $this->model = new $this->path();
    }

    /**
     * check if the filters has specific key.
     *
     * @param $key
     * @return bool
     */
    public function has($key): bool
    {
        return array_key_exists($key, $this->filters) && (
                $this->is_zero($this->safe_get($key))
                || (! $this->is_zero($this->safe_get($key)) && ! empty($this->safe_get($key)))
                || is_bool($this->safe_get($key))
            );
    }

    /**
     * check if the filters has any of some keys.
     *
     * @param array $keys
     * @return bool
     */
    public function hasAny(array $keys)
    {
        return Arr::hasAny($this->filters, $keys);
    }

    /**
     * get specific key from the filters.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, mixed $default = '')
    {
        $this->used[] = $key;

        return Arr::get($this->filters, $key, $default);
    }

    /**
     * apply provided filters.
     *
     * @param Builder $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        if ($this->has('impossible')) {
            $builder->whereNull($this->model->getTable().'.'.$this->model->getKeyName());

            return $builder;
        }

        return $this->fillable_build($this->filter_build($builder));
    }

    /**
     * get the value without marking the key as used.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    protected function safe_get(string $key, mixed $default = ''): mixed
    {
        return Arr::get($this->filters, $key, $default);
    }

    /**
     * add fillable attributes to the builder.
     *
     * @param Builder $builder
     * @return Builder
     */
    protected function fillable_build(Builder $builder): Builder
    {
        foreach ($this->model->getFillable() as $key) {
            if ($this->has($key) && ! in_array($key, $this->used)) {
                if (is_array($this->safe_get($key))) {
                    $builder->whereIn($this->model->qualifyColumn($key), $this->safe_get($key));
                } else {
                    $builder->where($this->model->qualifyColumn($key), $this->safe_get($key));
                }
            }
        }

        if ($this->has('id') && ! in_array('id', $this->used)) {
            if (is_array($this->safe_get('id'))) {
                $builder->whereIn($this->model->qualifyColumn($this->model->getKeyName()), $this->safe_get('id'));
            } else {
                $builder->where($this->model->qualifyColumn($this->model->getKeyName()), $this->safe_get('id'));
            }
        }

        if ($this->has('except') && ! in_array('except', $this->used)) {
            if (is_array($this->safe_get('except'))) {
                $builder->whereNotIn($this->model->qualifyColumn($this->model->getKeyName()), $this->safe_get('except'));
            } else {
                $builder->where($this->model->qualifyColumn($this->model->getKeyName()), '<>', $this->safe_get('except'));
            }
        }

        return $builder;
    }

    protected function only(array $filter): array
    {
        $data = [];
        foreach ($filter as $key) {
            if ($this->has($key)) {
                $data[$key] = $this->safe_get($key);
            }
        }

        return $data;
    }

    /**
     * check if value is zero.
     *
     * @param $value
     * @return bool
     */
    private function is_zero($value): bool
    {
        return $value === 0 || $value === '0';
    }

    /**
     * apply the filter.
     *
     * @param Builder $builder
     * @return Builder
     */
    abstract protected function filter_build(Builder $builder): Builder;
}
