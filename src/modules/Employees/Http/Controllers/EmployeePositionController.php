<?php 

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeRequest;

class EmployeePositionController extends BaseController
{

	protected $employeeRepository;

	public function getEmployeePositionNew()
	{
		return $this->printModal(view('employees::modals.edit_employee_position', [
						'employee_position' => null
					]));
	}

	public function postEmployeePositionNew(CreateEmployeePositionRequest $request)
	{
		return $this->printPartial(view('employees::partials.employee_position', [
						'employee_position' => $this->employeeRepository->createEmployeePosition($request->all()),
					]), trans('employees::employee_position.employee_position_created'));
	}

	public function getEmployeePositionEdit($id)
	{
		return $this->printModal(view('employees::modals.edit_employee_position', [
						'employee_position' => $this->employeeRepository->findEmployeePosition($id)
					]));
	}

	public function postEmployeePositionEdit(UpdateEmployeePositionRequest $request, $id)
	{
		return $this->printPartial(view('employees::partials.employee_position', [
						'employee_position' => $this->employeeRepository->updateEmployeePosition($request->all(), $id),
					]), trans('employees::employee_position.employee_position_updated'));
	}

	public function getEmployeeDepartmentList()
	{
		return view('employees::employee_position_list', ['employee_positions' => $this->employeeRepository->getEmployeePositions()]);
	}

	public function __construct(EmployeeRepository $employeeRepository)
	{
		$this->employeeRepository = $employeeRepository;
	}
}
