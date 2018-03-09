<?php

namespace Collejo\App\Modules\ACL\Http\Controllers;

use Auth;
use Collejo\App\Http\Controller;
use Collejo\App\Modules\ACL\Contracts\UserRepository;

class ACLController extends Controller
{
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
