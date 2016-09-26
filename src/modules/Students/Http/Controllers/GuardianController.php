<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\GuardianRepository;
use Collejo\App\Modules\Students\Criteria\GuardiansSearchCriteria;
use Collejo\App\Modules\Students\Http\Requests\UpdateGuardianRequest;
use Collejo\App\Modules\Students\Http\Requests\CreateGuardianRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateGuardianAccountRequest;

class GuardianController  extends BaseController
{

	protected $guardianRepository;

    public function getGuardianNew()
    {
        $this->authorize('create_guardian');
        
    	return $this->printModal(view('students::modals.edit_guardian', [
				'guardian' => null,
				'guradian_form_validator' => $this->jsValidator(CreateGuardianRequest::class)
			]));
    }

    public function postGuardianNew(CreateGuardianRequest $request)
    {
        $this->authorize('create_guardian');
        
        $guardian = $this->guardianRepository->createGuardian($request->all());

        return $this->printJson(true, ['guardian' => [
                'id' => $guardian->id,
                'name' => $guardian->name
            ]]);
    }

    public function getGuardianDetailView()
    {

        $this->authorize('list_student_categories');

    }

    public function getGuardianDetailEdit()
    {

        $this->authorize('list_student_categories');

    }

    public function postGuardianDetailEdit(UpdateGuardianRequest $request)
    {

        $this->authorize('list_student_categories');

    }

    public function getGuardianAccountView()
    {

        $this->authorize('list_student_categories');

    }

    public function getGuardianAccountEdit()
    {

        $this->authorize('list_student_categories');

    }

    public function postGuardianAccountEdit(UpdateGuardianAccountRequest $request)
    {

        $this->authorize('list_student_categories');

    }

	public function getGuardiansSearch(GuardiansSearchCriteria $criteria)
	{
        $this->authorize('list_student_categories');
        
		return $this->printJson(true, $this->guardianRepository->search($criteria)->get(['id'])
										->map(function($item){
											return ['id' => $item->id, 'name' => $item->name];
										})
								);
	}

	public function getGuardiansList()
	{
        $this->authorize('list_student_categories');
        
		return view('students::guardians_list', [
				'guardians' => $this->guardianRepository->getGuardians()->paginate(config('collejo.pagination.perpage'))
			]);		
	}

	public function __construct(GuardianRepository $guardianRepository)
	{
		$this->guardianRepository = $guardianRepository;
	}
}
