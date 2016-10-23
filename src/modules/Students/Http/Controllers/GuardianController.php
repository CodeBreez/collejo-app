<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\GuardianRepository;
use Collejo\App\Modules\Students\Criteria\GuardiansSearchCriteria;
use Collejo\App\Modules\Students\Http\Requests\UpdateGuardianRequest;
use Collejo\App\Modules\Students\Http\Requests\CreateGuardianRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateGuardianAccountRequest;
use Collejo\App\Modules\Students\Http\Requests\CreateAddressRequest;

class GuardianController  extends BaseController
{

	protected $guardianRepository;

    public function getGuardianAddressDelete($studentId, $addressId)
    {
        $this->authorize('edit_guardian_contact_details');

        $this->guardianRepository->deleteAddress($addressId, $studentId);

        return $this->printJson(true, [], trans('students::address.address_deleted'));
    }

    public function postGuardianAddressEdit(UpdateAddressRequest $request, $studentId, $addressId)
    {
        $this->authorize('edit_guardian_contact_details');

        $address = $this->guardianRepository->updateAddress($request->all(), $addressId, $studentId);

        return $this->printPartial(view('students::partials.guardian_address', [
                'guardian' => $this->guardianRepository->findGuardian($studentId),
                'address' => $address
            ]), trans('students::address.address_updated'));
    }

    public function getGuardianAddressEdit($studentId, $addressId)
    {
        $this->authorize('edit_guardian_contact_details');

        return $this->printModal(view('students::modals.edit_address', [
                'address' => $this->guardianRepository->findAddress($addressId, $studentId),
                'guardian' => $this->guardianRepository->findGuardian($studentId)
            ]));
    }

    public function postGuardianAddressNew(CreateAddressRequest $request, $studentId)
    {
        $this->authorize('edit_guardian_contact_details');

        $address = $this->guardianRepository->createAddress($request->all(), $studentId);

        return $this->printPartial(view('students::partials.guardian_address', [
                'guardian' => $this->guardianRepository->findGuardian($studentId),
                'address' => $address
            ]), trans('students::address.address_created'));
    }

    public function getGuardianAddressNew($studentId)
    {
        $this->authorize('edit_guardian_contact_details');

        return $this->printModal(view('students::modals.edit_guardian_address', [
                'address' => null,
                'guardian' => $this->guardianRepository->findGuardian($studentId)
            ]));
    }

    public function getGuardianAddressesView($studentId)
    {
        $this->authorize('view_guardian_contact_details');

        return view('students::view_guardian_addreses', ['guardian' => $this->guardianRepository->findGuardian($studentId)]);
    }       

    public function getGuardianAddressesEdit($studentId)
    {
        $this->authorize('view_guardian_contact_details');
        
        return view('students::edit_guardian_addreses', ['guardian' => $this->guardianRepository->findGuardian($studentId)]);
    }   

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

    public function getGuardianDetailView($guardianId)
    {
        $this->authorize('list_guardians');

        return view('students::view_guardian_details', [
                'guardian' => $this->guardianRepository->findGuardian($guardianId)
            ]); 
    }

    public function getGuardianDetailEdit($guardianId)
    {
        $this->authorize('edit_guardian');

        return view('students::edit_guardian_details', [
                'guardian' => $this->guardianRepository->findGuardian($guardianId),
                'guardian_form_validator' => $this->jsValidator(UpdateGuardianRequest::class)
            ]); 
    }

    public function postGuardianDetailEdit(UpdateGuardianRequest $request, $guardianId)
    {
        $this->authorize('edit_guardian');

        $this->guardianRepository->updateGuardian($request->all(), $guardianId);

        return $this->printJson(true, [], trans('students::guardian.guardian_updated'));
    }

    public function getGuardianAccountView($guardianId)
    {
        $this->middleware('reauth');
        
        $this->authorize('view_user_account_info');

        return view('students::view_guardian_account', [
                'guardian' => $this->guardianRepository->findGuardian($guardianId)
            ]); 
    }

    public function getGuardianAccountEdit($guardianId)
    {
        $this->middleware('reauth');
        
        $this->authorize('edit_user_account_info');

        return view('students::edit_guardian_account', [
                'guardian' => $this->guardianRepository->findGuardian($guardianId),
                'account_form_validator' => $this->jsValidator(UpdateGuardianAccountRequest::class)
            ]); 
    }

    public function postGuardianAccountEdit(UpdateGuardianAccountRequest $request, $guardianId)
    {
        $this->authorize('edit_user_account_info');

        $this->guardianRepository->updateGuardian($request->all(), $guardianId);

        return $this->printJson(true, [], trans('students::student.student_updated'));
    }

	public function getGuardiansSearch(GuardiansSearchCriteria $criteria)
	{
        $this->authorize('list_guardians');
        
		return $this->printJson(true, $this->guardianRepository->search($criteria)->get(['id'])
										->map(function($item){
											return ['id' => $item->id, 'name' => $item->name];
										})
								);
	}

	public function getGuardiansList(GuardiansSearchCriteria $criteria)
	{
        $this->authorize('list_guardians');
        
		return view('students::guardians_list', [
                'criteria' => $criteria,
				'guardians' => $this->guardianRepository->getGuardians($criteria)->with('user', 'students')
                                ->paginate(config('collejo.pagination.perpage'))
			]);		
	}

	public function __construct(GuardianRepository $guardianRepository)
	{
		$this->guardianRepository = $guardianRepository;
	}
}
