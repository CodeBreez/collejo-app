<?php

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\ACL\Http\Requests\UpdateUserAccountRequest;
use Collejo\App\Modules\ACL\Presenters\UserAccountPresenter;
use Collejo\App\Modules\Students\Contracts\GuardianRepository;
use Collejo\App\Modules\Students\Criteria\GuardiansListCriteria;
use Collejo\App\Modules\Students\Http\Requests\CreateGuardianRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateGuardianRequest;
use Collejo\App\Modules\Students\Presenters\GuardianDetailsPresenter;
use Collejo\App\Modules\Students\Presenters\GuardianListPresenter;

class GuardianController extends Controller
{
    protected $guardianRepository;

    /**
     * Get guardian account view.
     *
     * @param $guardianId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGuardianAccountView ($guardianId)
    {
        $this->authorize('view_user_account_info');

        $this->middleware('reauth');

        $guardian = $this->guardianRepository->findGuardian($guardianId);

        return view('students::view_guardian_account', [
            'user' => $guardian->user,
            'guardian' => $guardian
        ]);
    }

    /**
     * Get account edit form.
     *
     * @param $guardianId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGuardianAccountEdit($guardianId)
    {
        $this->authorize('edit_user_account_info');

        $this->middleware('reauth');

        $guardian = $this->guardianRepository->findGuardian($guardianId);

        return view('students::edit_guardian_account', [
            'guardian'            => $guardian,
            'user'                => present($guardian->user, UserAccountPresenter::class),
            'user_form_validator' => $this->jsValidator(UpdateUserAccountRequest::class),
        ]);
    }

    /**
     * Post account edit form.
     *
     * @param UpdateUserAccountRequest $request
     * @param $guardianId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postGuardianAccountEdit(UpdateUserAccountRequest $request, $guardianId)
    {
        $this->authorize('edit_user_account_info');

        $this->middleware('reauth');

        $this->guardianRepository->updateGuardian($request->all(), $guardianId);

        return $this->printJson(true, [], trans('students::guardian.guardian_updated'));
    }
    /**
     * Get create guardian form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function getGuardianNew()
    {
        $this->authorize('create_guardian');

        return view('students::edit_guardian_details', [
            'guardian'                        => null,
            'guardian_details_form_validator' => $this->jsValidator(CreateGuardianRequest::class),
        ]);
    }

    /**
     * Save new guardian data
     *
     * @param CreateGuardianRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function postGuardianNew(CreateGuardianRequest $request)
    {
        $this->authorize('create_guardian');

        $guardian = $this->guardianRepository->createGuardian($request->all());

        return $this->printRedirect(route('guardian.details.edit', $guardian->id),
            trans('students::guardian.guardian_created'));
    }

    /**
     * Get guardian details view
     *
     * @param $guardianId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getGuardianDetailView($guardianId)
    {
        $this->authorize('list_guardians');

        return view('students::view_guardian_details', [
            'guardian' => present($this->guardianRepository->findGuardian($guardianId),
                GuardianDetailsPresenter::class)
        ]);
    }

    /**
     * Get guardian details edit form
     *
     * @param $guardianId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function getGuardianDetailEdit($guardianId)
    {
        $this->authorize('edit_guardian');

        return view('students::edit_guardian_details', [
            'guardian' => present($this->guardianRepository->findGuardian($guardianId), GuardianDetailsPresenter::class),
            'guardian_details_form_validator' => $this->jsValidator(UpdateGuardianRequest::class)
        ]);
    }

    /**
     * Save guardian details form
     *
     * @param UpdateGuardianRequest $request
     * @param $guardianId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function postGuardianDetailEdit(UpdateGuardianRequest $request, $guardianId)
    {
        $this->authorize('edit_guardian');

        $this->guardianRepository->updateGuardian($request->all(), $guardianId);

        return $this->printJson(true, [], trans('students::guardian.guardian_updated'));
    }

    /**
     * @param GuardiansListCriteria $criteria
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGuardiansList(GuardiansListCriteria $criteria)
    {
        $this->authorize('list_guardians');

        return view('students::guardians_list', [
            'criteria'  => $criteria,
            'guardians' => present($this->guardianRepository->getGuardians($criteria)->with('user', 'students')
                ->paginate(config('collejo.pagination.perpage')), GuardianListPresenter::class),
        ]);
    }

    public function __construct(GuardianRepository $guardianRepository)
    {
        $this->guardianRepository = $guardianRepository;
    }
}
