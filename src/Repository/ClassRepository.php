<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Core\Contracts\Repository\ClassRepository as ClassRepositoryContract;
use Collejo\App\Models\Batch;
use DB;

class ClassRepository extends BaseRepository implements ClassRepositoryContract {

	public function getBatches()
	{
		return Batch::all();
	}

    function model()
    {
        return Batch::class;
    }

    public function boot()
    {
    	parent::boot();
    }
}