<?php

namespace Collejo\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Models\User;

class UserRepository extends BaseRepository {

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return User::class;
    }
}