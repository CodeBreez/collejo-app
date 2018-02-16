<?php

namespace Collejo\Foundation\Repository;

use Auth;
use Uuid;
use Carbon;

abstract class BaseRepository
{
    protected $sessionOwner;

    /**
     * Performs a search using the given criteria object.
     *
     * @param $criteria
     *
     * @return CacheableResult
     */
    public function search($criteria)
    {
        if ($criteria instanceof CriteriaInterface) {
            $criteria = $criteria->buildQuery();
        } else {
            $criteria = new $criteria();
            $criteria = $criteria->select('*');
        }

        return new CacheableResult($criteria);
    }

    /**
     * Returns an array of fillable fields for the given model class.
     *
     * @param array $attributes
     * @param $class
     *
     * @return array
     */
    public function parseFillable(array $attributes, $class)
    {
        $model = new $class();

        return array_intersect_key($attributes, array_flip($model->getFillable()));
    }

    /**
     * Generates a new UUID string.
     *
     * @return string
     */
    public function newUuid()
    {
        return (string) Uuid::generate(4);
    }

    /**
     * Creates pivot ids for the pivot table.
     *
     * @param $ids
     *
     * @return array
     */
    public function createPivotIds($ids)
    {
        $collection = collect($ids);

        $collection = $collection->map(function () {
            return $this->includePivotMetaData();
        });

        return array_combine($ids, $collection->all());
    }

    /**
     * Include extra meta data for the pivot row.
     *
     * @param array $attributes
     *
     * @return array
     */
    public function includePivotMetaData(array $attributes = [])
    {
        if (!isset($attributes['id'])) {
            $attributes['id'] = $this->newUuid();
        }

        if (!isset($attributes['created_at'])) {
            $attributes['created_at'] = Carbon::now();
        }

        if (!isset($attributes['created_by']) && Auth::user()) {
            $attributes['created_by'] = Auth::user()->id;
        }

        return $attributes;
    }

    /**
     * Boot up repository.
     */
    public function boot()
    {
        $this->sessionOwner = Auth::user();
    }

    public function __construct()
    {
        $this->boot();
    }
}
