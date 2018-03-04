<?php

namespace Collejo\Foundation\Criteria;

use Request;
use DB;
use Cache;

abstract class BaseCriteria implements CriteriaInterface {

	protected $model;

	protected $criteria = [];

	protected $selects = [];

	protected $joins = [];

	protected $form = [];

    /**
     * Builds the SQL query required for filtering results
     *
     * @return mixed
     */
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

		return $builder;
	}

    /**
     * Returns the model object for this criteria
     *
     * @return mixed
     */
	private function getModel()
	{
		if ($this->model) {
			$model = $this->model;
			return new $model();
		}
	}

    /**
     * Returns an array of form elements
     * @return \Illuminate\Support\Collection
     */
	public function formElements()
	{
		$form = $this->form()->all();

		return $this->criteria()->map(function($item) use ($form){

			$name = count($item) == 3 ? $item[2] : $item[0];

			return array_merge([
					'name' => $name,
					'label' => ucwords(str_replace('_', ' ', $name)),
					'type' => 'text',
                    'value' => Request::get($name)
				], isset($form[$name]) ? $form[$name] : []);
		});
	}

    /**
     * Returns the renderable json string for the form elements
     * @return string
     */
	public function toJson()
    {
        return json_encode($this->formElements());
    }

    /**
     * Returns the sub query required for the criteria
     *
     * @param $query
     * @return mixed
     */
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

    /**
     * Binds any callback functions required for this criteria
     *
     * @param $callback
     * @return mixed
     */
	public function callback($callback)
	{
		$callback = 'callback' . ucfirst($callback);

		$key = 'criteria:' . $this->model . ':callbacks:' . md5(get_class($this) . '|' . $callback);

		if (!Cache::has($key)) {
			Cache::put($key, $this->$callback(), config('collejo.pagination.perpage'));
		}

		return Cache::get($key);
	}

    /**
     * Returns an array of select queries for this criteria
     *
     * @return \Illuminate\Support\Collection
     */
	public function selects()
	{
		return collect($this->selects);
	}

    /**
     * Returns an of join queries for this criteria
     *
     * @return \Illuminate\Support\Collection
     */
	public function joins()
	{
		return collect($this->joins);
	}

    /**
     * Returns an array of fields for this criteria
     *
     * @return \Illuminate\Support\Collection|mixed
     */
	public function criteria()
	{
		return collect($this->criteria);
	}

    /**
     * Returns an array of form fields for this criteria
     *
     * @return \Illuminate\Support\Collection
     */
	public function form()
	{
		return collect($this->form);
	}
}