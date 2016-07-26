<?php 

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeDetailsRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeDetailsRequest;

class EmployeeController extends BaseController
{

	protected $employeeRepository;

	public function getEmployeeAddressesView()
	{

	}

	public function getEmployeeAddressesEdit()
	{

	}

	public function getEmployeeAddressNew()
	{

	}

	public function postEmployeeAddressNew()
	{

	}

	public function getEmployeeAddressEdit()
	{

	}

	public function postEmployeeAddressEdit()
	{

	}

	public function getEmployeeAddressDelete()
	{

	}

	public function getEmployeeAccountView()
	{

	}

	public function getEmployeeAccountEdit()
	{

	}

	public function postEmployeeAccountEdit()
	{

	}


	public function getEmployeeNew()
	{
		return view('employees::edit_employee_details', [
						'employee' => null,
						'employee_positions' => $this->employeeRepository->getEmployeePositions(),
						'employee_departments' => $this->employeeRepository->getEmployeeDepartments(),
						'employee_grades' => $this->employeeRepository->getEmployeeGrades(),
					]);
	}

	public function postEmployeeNew(CreateEmployeeDetailsRequest $request)
	{
		$employee = $this->employeeRepository->create($request->all());

		return $this->printRedirect(route('employee.details.edit', $employee->id));
	}

	public function getEmployeeDetailsEdit($id)
	{
		return view('employees::edit_employee_details', [
						'employee' => $this->employeeRepository->find($id),
						'employee_positions' => $this->employeeRepository->getEmployeePositions(),
						'employee_departments' => $this->employeeRepository->getEmployeeDepartments(),
						'employee_grades' => $this->employeeRepository->getEmployeeGrades(),
					]);
	}

	public function postEmployeeDetailsEdit(UpdateEmployeeDetailsRequest $request, $id)
	{

	}

	public function getEmployeeList()
	{
		return view('employees::employee_list', ['employees' => $this->employeeRepository->getEmployees()->paginate()]);
	}

	public function __construct(EmployeeRepository $employeeRepository)
	{
		$this->employeeRepository = $employeeRepository;
	}
}
