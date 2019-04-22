<?php

namespace Collejo\Foundation\Presenter;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaginatedPresenter
{

    protected $paginator;

    protected $presenter;

    public function present()
    {
        $collectionPresenter = new CollectionPresenter($this->paginator->getCollection(), $this->presenter);

        $this->paginator->setCollection($collectionPresenter->present());

        return $this->paginator;
    }

    public function __construct(LengthAwarePaginator $paginator, $presenter)
    {
        $this->paginator = $paginator;

        $this->presenter = $presenter;
    }
}