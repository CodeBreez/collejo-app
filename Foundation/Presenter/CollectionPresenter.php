<?php

namespace Collejo\Foundation\Presenter;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CollectionPresenter
{
    protected $collection;

    protected $presenter;

    public function present()
    {
        $presenter = new $this->presenter();

        return $this->collection->map(function ($item) use ($presenter) {
            $presented = $item->setHidden($presenter->getHiddenKeys())->append($presenter->getAppendedKeys())->toArray();

            foreach ($presenter->getLoadKeys() as $loadKey) {
                $modelPresenter = new ModelPresenter($item->$loadKey, $presenter->getLoadPresenter($loadKey));

                $presented[Str::snake($loadKey)] = $modelPresenter->present();
            }

            foreach ($presenter->getDecorators() as $decoratedKey => $decoratorClass){

                $decorator = new $decoratorClass();

                $presented[$decoratedKey] = $decorator->decorated($presented[$decoratedKey]);
            }

            return $presented;
        });
    }

    public function __construct(Collection $collection, $presenter)
    {
        $this->collection = $collection;

        $this->presenter = $presenter;
    }
}
