<?php

namespace Collejo\Foundation\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Cache;

class CacheableResult {

    private $builder;

    private $columns;

    public function get($columns = ['*'])
    {
        $this->columns = $columns;

        return $this->getResult($columns);
    }

    public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $this->columns = $columns;

        $page = $page ?: Paginator::resolveCurrentPage($pageName);

        $perPage = $perPage ?: $this->builder->getPerPage();

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

    public function with()
    {
        $this->builder->with(func_get_args());
        return $this;
    }

    public function withTrashed()
    {
        $this->builder->withTrashed(func_get_args());
        return $this;
    }

    public function count()
    {
        return $this->builder->count();
    }

    private function getResult()
    {
        $key = 'criteria:' . get_class($this->builder->getModel()) . ':' . $this->getQueryHash() . ':result';

        $builder = $this->builder;

        return Cache::remember($key, config('collejo.perpage'), function() use ($builder){
            return $this->builder->get();
        });
    }

    private function getQueryHash()
    {
        return md5($this->builder->toSql() . '|' . implode(',', $this->columns));
    }

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }
}
