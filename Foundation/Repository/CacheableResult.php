<?php

namespace Collejo\Foundation\Repository;

use Cache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class CacheableResult {

    private $builder;

    private $columns;

	/**
	 * Get entities
	 *
	 * @param array $columns
	 *
	 * @return mixed
	 */
    public function get($columns = ['*'])
    {
        $this->columns = $columns;

        return $this->getResult($columns);
    }

	/**
	 * Paginate result
	 *
	 * @param int $perPage
	 * @param array $columns
	 * @param string $pageName
	 * @param null $page
	 *
	 * @return LengthAwarePaginator
	 */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $this->columns = $columns;

        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        $perPage = $perPage ?: config('collejo.pagination.perpage');

        $query = $this->builder->toBase();

        $key = 'criteria:' . get_class($this->builder->getModel()) . ':' . $this->getQueryHash() . ':count';

        $total = Cache::remember($key, config('collejo.pagination.perpage'), function() use ($key, $query){

            return $query->getCountForPagination();
        });

        $results = new Collection;

        if ($total) {
            $this->builder->forPage($page, $perPage);
            $results = $this->getResult();
        }

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $pageName,
        ]);
    }

	/**
	 * Return relationships
	 *
	 * @return $this
	 */
    public function with()
    {
        $this->builder->with(func_get_args());

        return $this;
    }

	/**
	 * Return deletes entities
	 *
	 * @return $this
	 */
    public function withTrashed()
    {
        $this->builder->withTrashed(func_get_args());

        return $this;
    }

	/**
	 * Count entities
	 *
	 * @return int
	 */
    public function count()
    {
        return $this->builder->count();
    }

	/**
	 * Return the result for the query and cache it
	 *
	 * @return mixed
	 */
    private function getResult()
    {
        $key = 'criteria:' . get_class($this->builder->getModel()) . ':' . $this->getQueryHash() . ':result';

        $builder = $this->builder;

        return Cache::remember($key, config('collejo.pagination.perpage'), function () use ($builder) {

            return $this->builder->get();
        });
    }

	/**
	 * Generates a hash for the current query
	 *
	 * @return string
	 */
    private function getQueryHash()
    {
        return md5($this->builder->toSql() . '|' . implode(',', $this->columns));
    }

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }
}
