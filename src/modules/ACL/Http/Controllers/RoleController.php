<?php

namespace Collejo\App\Modules\ACL\Http\Controllers;

use Collejo\App\Http\Controllers\Controller;
use Collejo\App\Repository\UserRepository;

class RoleController extends Controller
{	
	private $userRepository;

    public function getRoles()
    {
        return view('acl::roles_list', ['roles' => $this->userRepository->getRoles()->paginate(config('collejo.pagination.perpage'))]);
    }

    public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}
}
