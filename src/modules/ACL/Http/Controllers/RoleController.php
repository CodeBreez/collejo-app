<?php

namespace Collejo\App\Modules\ACL\Http\Controllers;

use Collejo\App\Http\Controllers\Controller;
use Collejo\App\Repository\UserRepository;
use Module;
use Request;

class RoleController extends Controller
{	
	private $userRepository;

	public function postRolePermmissionsEdit(Request $request, $roleId, $moduleName)
	{
		$this->userRepository->syncRolePermissions($this->userRepository->findRole($roleId), $request::get('permissions'), $moduleName);
	}

	public function getRolePermmissionsEdit($roleId, $moduleName)
	{
		return view('acl::edit_role_permissions', [
				'module' => Module::find($moduleName),
				'role' => $this->userRepository->findRole($roleId),
				'userRepository' => $this->userRepository
			]);
	}

    public function getRoles()
    {
        return view('acl::roles_list', [
        		'module' => Module::first(),
        		'roles' => $this->userRepository->getRoles()->paginate()
        	]);
    }

    public function __construct(UserRepository $userRepository)
	{
		$this->authorize('add_remove_permission_to_role');

		$this->userRepository = $userRepository;
	}
}
