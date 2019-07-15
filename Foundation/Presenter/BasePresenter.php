<?php

namespace Collejo\Foundation\Presenter;

use Illuminate\Support\Str;

abstract class BasePresenter
{
    protected $load = [];

    protected $hidden = [];

    protected $appends = [];

    protected $decorate = [];

    public function getAppendedKeys()
    {
        return $this->appends;
    }

    public function getHiddenKeys()
    {
        return $this->hidden;
    }

    public function getLoadKeys()
    {
        return array_map(function ($key) {
            return Str::camel($key);
        }, array_keys($this->load));
    }

    public function getLoadPresenter($key)
    {
        return $this->load[Str::snake($key)];
    }

    public function getDecorators()
    {
        return $this->decorate;
    }
}
