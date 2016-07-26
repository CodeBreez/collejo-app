<?php 

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeDepartmentRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeDepartmentRequest;

class EmployeeDepartmentController extends BaseController
{

	protected $employeeRepository;

	public function getEmployeeDepartmentNew()
	{
		return $this->printModal(view('employees::modals.edit_employee_department', [
						'employee_department' => null
					]));
	}

	public function postEmployeeDepartmentNew(CreateEmployeeDepartmentRequest $request)
	{
		return $this->printPartial(view('employees::partials.employee_department', [
						'employee_department' => $this->employeeRepository->createEmployeeDepartment($request->all()),
					]), trans('employees::employee_department.employee_department_created'));
	}

	public function getEmployeeDepartmentEdit($id)
	{
		return $this->printModal(view('employees::modals.edit_employee_department', [
						'employee_department' => $this->employeeRepository->findEmployeeDepartment($id)
					]));
	}

	public function postEmployeeDepartmentEdit(UpdateEmployeeDepartmentRequest $request, $id)
	{
		return $this->printPartial(view('employees::partials.employee_department', [
						'employee_department' => $this->employeeRepository->updateEmployeeDepartment($request->all(), $id),
					]), trans('employees::employee_department.employee_department_updated'));
	}

	public function getEmployeeDepartmentList()
	{
		return view('employees::employee_department_list', ['employee_departments' => $this->employeeRepository->getEmployeeDepartments()]);
	}

	public function __construct(EmployeeRepository $employeeRepository)
	{
		$this->employeeRepository = $employeeRepository;
	}
}
