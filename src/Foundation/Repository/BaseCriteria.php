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

		$model = $model->select($model->getTable() . '.*')
					->join(DB::raw('(' . $this->getSubquery($model)->toSql() . ') as tmp'), $model->getTable() . '.id', '=', 'tmp.id');

		foreach ($this->criteria() as $params) {

			$input = isset($params[2]) ? $params[2] : $params[0];

			if (Request::has($input)) {

				switch ($params[1]) {
					case '%LIKE':
						$model = $model->orWhere('tmp.' . $params[0], 'LIKE', '%' . Request::get($input));
						break;					

					case 'LIKE%':
						$model = $model->orWhere('tmp.' . $params[0], 'LIKE', Request::get($input) . '%');
						break;

					case '%LIKE%':
						$model = $model->orWhere('tmp.' . $params[0], 'LIKE', '%' . Request::get($input) . '%');
						break;
					
					default:
						$model = $model->orWhere('tmp.' . $params[0], $params[1], Request::get($input));
						break;
				}
			}
		}

		return $model;
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
			$query = $query->join($join[0], $join[1], '=', $join[2]);
		}

		return $query;
	}

	public function callback($callback)
	{
		$callback = 'callback' . ucfirst($callback);
		return $this->$callback();
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