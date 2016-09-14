<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\GuardianRepository;
use Collejo\App\Modules\Students\Criteria\GuardiansSearchCriteria;

class GuardianController  extends BaseController
{

	protected $guardianRepository;

	public function getGuardiansSearch(GuardiansSearchCriteria $criteria)
	{
		return $this->printJson(true, $this->guardianRepository->search($criteria)->get(['id'])->map(function($item){
			return [
				'id' => $item->id,
				'name' => $item->name
			];
		}));
	}

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
