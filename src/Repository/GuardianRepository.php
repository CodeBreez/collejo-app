<?php

namespace Collejo\App\Repository;

use Collejo\Core\Foundation\Repository\BaseRepository;
use Collejo\Core\Contracts\Repository\GuardianRepository as GuardianRepositoryContract;
use Collejo\App\Models\Guardian;

class GuardianRepository extends BaseRepository implements GuardianRepositoryContract {

	public function getGuardians()
	{
		return $this->search(Guardian::class);
	}
}