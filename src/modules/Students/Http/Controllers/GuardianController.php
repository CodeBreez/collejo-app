<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\GuardianRepository;

class GuardianController  extends BaseController
{

	protected $guardianRepository;

	public function getGuardiansList()
	{
		return view('students::guardians_list', [
				'guardians' => $this->guardianRepository->getGuardians()->paginate(config('collejo.pagination.perpage'))
			]);		
	}

	public function __construct(GuardianRepository $guardianRepository)
	{
		$this->guardianRepository = $guardianRepository;
	}
}
