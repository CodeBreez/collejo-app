<?php

namespace Collejo\Foundation\Presenter;

use ArrayAccess;
use Countable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use IteratorAggregate;
use JsonSerializable;

class Presented implements ArrayAccess, Arrayable, Countable, IteratorAggregate, Jsonable, JsonSerializable
{
    protected $collection;

    public function jsonSerialize()
    {
        return $this->collection->jsonSerialize();
    }

    public function toJson($options = 0)
    {
        return $this->collection->toJson($options);
    }

    public function getIterator()
    {
        return $this->collection->getIterator();
    }

    public function count()
    {
        return $this->collection->count();
    }

    public function toArray()
    {
        return $this->collection->toArray();
    }

    public function __get($key)
    {
        return $this->collection->get($key);
    }

    public function __construct($collection)
    {
        $this->collection = collect($collection);
    }

    public function offsetExists($key)
    {
        return $this->collection->offsetExists($key);
    }

    public function offsetGet($key)
    {
        return $this->collection->offsetGet($key);
    }

    public function offsetSet($key, $value)
    {
        return $this->collection->offsetSet($key, $value);
    }

    public function offsetUnset($key)
    {
        return $this->collection->offsetUnset($key);
    }
}
