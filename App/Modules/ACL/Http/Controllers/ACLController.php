<?php

namespace Collejo\App\Modules\ACL\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\ACL\Contracts\UserRepository;

class ACLController extends Controller
{
    public function getNewUser()
    {
    }

    /**
     * Returns the view for user details.
     *
     * @param $userId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUserDetails($userId)
    {
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
    public function getManage()
    {
        $this->authorize('view_user_account_info');

        return view('acl::users_list', [
            'users' => $this->userRepository->getUsers()->paginate(config('collejo.pagination.perpage')),
        ]);
    }

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
