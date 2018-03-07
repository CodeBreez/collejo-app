<?php

namespace Collejo\App\Foundation\Repository;

interface RepositoryInterface
{
    public function parseFillable(array $attributes, $class);

    public function newUuid();

    public function createPrivotIds($ids);

    public function boot();

    public function search($model);
}
