<?php

namespace Collejo\Foundation\Presenter;

abstract class ModelDecorator
{
    protected $modelReference = [];

    public function getDecorators()
    {
        return $this->modelReference;
    }

    public function decorated($presented)
    {
        foreach ($this->getDecorators() as $decoratedKey => $decorate) {
            $decoratedModel = $decorate[0];
            $presenterClass = $decorate[1];
            $alias = $decorate[2];

            $decoratedModel = new $decoratedModel();
            $decoratedModel = $decoratedModel::find($presented[$decoratedKey]);

            if ($decoratedModel && $presenterClass) {
                $presentable = present($decoratedModel, $presenterClass);
            }

            if ($alias) {
                $presented[$alias] = $presentable;
                unset($presented[$decoratedKey]);
            } else {
                $presented[$decoratedKey] = $presentable;
            }
        }

        return $presented;
    }
}
