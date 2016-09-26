<?php 

namespace Collejo\App\Foundation\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Cache;

class CacheableResult {

	private $builder;

	public function get($columns = ['*'])
	{
		return $this->getResult($columns);
	}

	public function paginate($perPage = 15, $columns = ['*'], $pageName = 'page', $page = null)
	{
		$page = $page ?: Paginator::resolveCurrentPage($pageName);

        $perPage = $perPage ?: $this->builder->getPerPage();

        $query = $this->builder->toBase();

        $total = $query->getCountForPagination();
        $results = new Collection;

        if ($total) {
        	$this->builder->forPage($page, $perPage);
        	$results = $this->getResult($columns);
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
		$this->builder->count();
		return $this;
	}

	private function getResult($columns)
	{
		$key = 'criteria-' . md5($this->builder->toSql() . '|' . implode(',', $columns));

		if (!Cache::has($key)) {
			Cache::put($key, $this->builder->get(), config('collejo.pagination.perpage'));
		}

		return Cache::get($key);
	}

	public function __construct(Builder $builder)
	{
		$this->builder = $builder;
	}
}
