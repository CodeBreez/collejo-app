<?php 

namespace Collejo\App\Foundation\Repository;

use Collejo\App\Foundation\Repository\CriteriaInterface;
use Request;
use DB;
use Cache;

abstract class BaseCriteria implements CriteriaInterface {

	protected $model;

	protected $criteria = [];

	protected $selects = [];

	protected $joins = [];

	protected $form = [];

	public function buildQuery()
	{
		$model = $this->getModel();

		$builder = $model->select($model->getTable() . '.*')
					->join(DB::raw('(' . $this->getSubquery($model)->toSql() . ') as tmp'), $model->getTable() . '.id', '=', 'tmp.id');

		foreach ($this->criteria() as $params) {

			$input = isset($params[2]) ? $params[2] : $params[0];

			if (Request::has($input)) {

				switch ($params[1]) {
					case '%LIKE':
						$builder = $builder->orWhere('tmp.' . $params[0], 'LIKE', '%' . Request::get($input));
						break;					

					case 'LIKE%':
						$builder = $builder->orWhere('tmp.' . $params[0], 'LIKE', Request::get($input) . '%');
						break;

					case '%LIKE%':
						$builder = $builder->orWhere('tmp.' . $params[0], 'LIKE', '%' . Request::get($input) . '%');
						break;
					
					default:
						$builder = $builder->orWhere('tmp.' . $params[0], $params[1], Request::get($input));
						break;
				}
			}
		}

		return $builder->orderBy($model->getTable() . '.created_at', 'DESC');
	}

	private function getModel()
	{
		if ($this->model) {
			$model = $this->model;
			return new $model();
		}
	}

	public function formElements()
	{
		$form = $this->form()->all();

		return $this->criteria()->map(function($item) use ($form){

			$name = count($item) == 3 ? $item[2] : $item[0];

			return array_merge([
					'name' => $name,
					'label' => ucwords(str_replace('_', ' ', $name)),
					'type' => 'text'
				], isset($form[$name]) ? $form[$name] : []);
		});
	}

	private function getSubquery($query)
	{
		$selects = [$query->getTable() . '.*'];

		foreach ($this->selects() as $as => $field) {
			$selects[] = $field . ' AS ' . $as;
		}

		$query = $query->select(DB::raw(implode(', ', $selects)));

		foreach ($this->joins() as $join) {
			$query = $query->leftJoin($join[0], $join[1], '=', $join[2]);
		}

		return $query;
	}

	public function callback($callback)
	{
		$callback = 'callback' . ucfirst($callback);

		$key = 'criteria:' . $this->model . ':callbacks:' . md5(get_class($this) . '|' . $callback);

		if (!Cache::has($key)) {
			Cache::put($key, $this->$callback(), config('collejo.pagination.perpage'));
		}

		return Cache::get($key);
	}

	public function selects()
	{
		return collect($this->selects);
	}

	public function joins()
	{
		return collect($this->joins);
	}

	public function criteria()
	{
		return collect($this->criteria);
	}

	public function form()
	{
		return collect($this->form);
	}
}