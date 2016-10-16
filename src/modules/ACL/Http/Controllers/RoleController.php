<?php

namespace Collejo\App\Modules\ACL\Http\Controllers;

use Collejo\App\Http\Controllers\Controller;
use Collejo\App\Repository\UserRepository;
use Collejo\App\Modules\ACL\Http\Requests\CreateRoleRequest;
use Module;
use Request;

class RoleController extends Controller
{	
	private $userRepository;

	public function getRoleEnable($roleId)
	{
		$this->userRepository->enableRole($roleId);

		return $this->printJson(true, [], trans('acl::role.enabled'));
	}

	public function getRoleDisable($roleId)
	{
		$this->userRepository->disableRole($roleId);

		return $this->printJson(true, [], trans('acl::role.disabled'));
	}

	public function postRoleNew(CreateRoleRequest $request)
	{
		$role = $this->userRepository->createRoleIfNotExists($request->get('role'));

		return $this->printRedirect(route('role.permissions.edit', [$role->id, Module::first()->name]));
	}

	public function getRoleNew()
	{
		return $this->printModal(view('acl::modals.edit_role', [
        		'module' => Module::first(),
        		'role' => null,
        		'role_form_validator' => $this->jsValidator(CreateRoleRequest::class)
        	]));
	}

	public function postRolePermmissionsEdit(Request $request, $roleId, $moduleName)
	{
		$this->userRepository->syncRolePermissions($this->userRepository->findRole($roleId), $request::get('permissions', []), $moduleName);

		return $this->printJson(true, [], trans('acl::role.updated'));
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
        		'roles' => $this->userRepository->getRoles()->orderBy('created_at')->withTrashed()->paginate()
        	]);
    }

    public function __construct(UserRepository $userRepository)
	{
		$this->authorize('add_remove_permission_to_role');

		$this->userRepository = $userRepository;
	}
}
