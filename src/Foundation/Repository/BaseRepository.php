<?php 

namespace Collejo\App\Foundation\Repository;

use Collejo\App\Foundation\Repository\RepositoryInterface;
use Collejo\App\Foundation\Repository\CriteriaInterface;
use Collejo\App\Foundation\Repository\CacheableResult;
use Uuid;
use Auth;
use Carbon;
use Request;
use Session;

abstract class BaseRepository implements RepositoryInterface {

	protected $sessionOwner;

	public function search($criteria)
	{
		if ($criteria instanceOf CriteriaInterface) {
			$criteria = $criteria->buildQuery();
		} else {
			$criteria = new $criteria();
		}

		return new CacheableResult($criteria->orderBy('created_at', 'DESC'));
	}

	public function parseFillable(array $attributes, $class)
	{
		$model = new $class();
		return array_intersect_key($attributes, array_flip($model->getFillable()));
	}

	public function newUuid()
	{
		return (string) Uuid::generate(4);
	}

	public function createPrivotIds($ids)
	{
		$collection = collect($ids);

		$collection = $collection->map(function(){
			return ['id' => $this->newUUID()];
		});

		return array_combine($ids, $collection->all());
	}

	public function boot()
	{
		$this->sessionOwner = Auth::user();
	}

    public function __construct()
    {
        $this->boot();
    }	
}