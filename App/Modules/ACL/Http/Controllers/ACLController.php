<?php

namespace Collejo\App\Modules\ACL\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\ACL\Contracts\UserRepository;
use Collejo\App\Modules\ACL\Criteria\UserListCriteria;
use Collejo\App\Modules\ACL\Http\Requests\CreateUserRequest;
use Collejo\App\Modules\ACL\Http\Requests\UpdateUserRequest;
use Request;

class ACLController extends Controller
{

    /**
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getUserRolesView($userId)
    {

        $this->authorize('view_user_account_info');

        return view('acl::view_user_roles', [
            'user' => $this->userRepository->findUser($userId),
        ]);
    }

    /**
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getUserRolesEdit($userId)
    {

        $this->authorize('edit_user_account_info');

        return view('acl::edit_user_roles', [
            'user' => $this->userRepository->findUser($userId, 'roles'),
            'roles' => $this->userRepository->getRoles()->get()
        ]);
    }

    /**
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function postUserRolesEdit(Request $request, $userId)
    {

        $this->authorize('edit_user_account_info');

        $this->userRepository->assignRolesToUser($request::get('roles', []), $userId);

        return $this->printJson(true, [], trans('acl::user.user_updated'));
    }

    /**
     * Create user and redirect to the new user details.
     *
     * @param CreateUserRequest $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postNewUser(CreateUserRequest $request)
    {
        $this->authorize('create_user_accounts');

        $user = $this->userRepository->create($request->all());

        return $this->printRedirect(route('user.details.edit', $user->id));
    }

    /**
     * Returns the view for the create user form.
     *
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNewUser()
    {
        $this->authorize('create_user_accounts');

        return view('acl::edit_user_details', [
            'user'                => null,
            'user_form_validator' => $this->jsValidator(CreateUserRequest::class),
        ]);
    }

    /**
     * Updates a user and displays a message.
     *
     * @param UpdateUserRequest $request
     * @param $userId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUserDetailsEdit(UpdateUserRequest $request, $userId)
    {
        $this->authorize('edit_user_account_info');

        $this->userRepository->update($request->all(), $userId);

        return $this->printJson(true, [], trans('acl::user.user_updated'));
    }

    /**
     * Returns the view for user details.
     *
     * @param $userId
     *
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserDetailsEdit($userId)
    {
        $this->authorize('edit_user_account_info');

        return view('acl::edit_user_details', [
            'user'                => $this->userRepository->findUser($userId),
            'user_form_validator' => $this->jsValidator(UpdateUserRequest::class),
        ]);
    }

    /**
     * Returns the view for user details.
     *
     * @param $userId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserDetailsView($userId)
    {
        $this->authorize('view_user_account_info');

        return view('acl::view_user_details', [
            'user' => $this->userRepository->findUser($userId),
        ]);
    }

    /**
     * Returns the UI for managing users.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getManage(UserListCriteria $criteria)
    {
        $this->authorize('view_user_account_info');

        return view('acl::users_list', [
            'criteria' => $criteria,
            'users'  => $this->userRepository
                ->getUsers($criteria)
                ->with('roles')
                ->paginate(),
        ]);
    }

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
