<?php

namespace Collejo\Foundation\Presenter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ModelPresenter
{
    protected $model;

    protected $presenter;

    public function present()
    {
        $presenter = new $this->presenter;

        $presentedModel = $this->model->loadMissing($presenter->getLoadKeys())
            ->setHidden($presenter->getHiddenKeys())
            ->append($presenter->getAppendedKeys());

        $presented = $presentedModel->toArray();

        foreach($presenter->getLoadKeys() as $loadKey){

            $loadedKeyModel = $presentedModel->$loadKey;

            if($loadedKeyModel){

                $modelPresenter = new ModelPresenter($loadedKeyModel, $presenter->getLoadPresenter($loadKey));

                $presented[Str::snake($loadKey)] =  $modelPresenter->present();
            }
        }

        return (object) $presented;
    }

    public function __construct(Model $model, $presenter)
    {
        $this->model = $model;

        $this->presenter = $presenter;
    }
}