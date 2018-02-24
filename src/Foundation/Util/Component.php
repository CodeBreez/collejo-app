<?php

namespace Collejo\App\Foundation\Util;

use Illuminate\Contracts\Support\Arrayable;

abstract class Component implements Arrayable
{
    public function getKey()
    {
        return $this->name;
    }

    public function __get($req)
    {
        if (property_exists($this, $req)) {
            return $this->$req;
        } elseif (method_exists($this, $req)) {
            return $this->$req();
        }
    }
}
