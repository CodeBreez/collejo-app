<?php 

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeDetailsRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeDetailsRequest;
use Collejo\App\Modules\Employees\Criteria\EmployeeListCriteria;

class EmployeeController extends BaseController
{

	protected $employeeRepository;

	public function getEmployeeDetailsView($employeeId)
	{
		return view('employees::view_employee_details', [
			'employee' => $this->employeeRepository->findEmployee($employeeId)
		]);
	}

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
		$this->middleware('reauth');
	}

	public function postEmployeeAccountEdit()
	{
		$this->middleware('reauth');
	}


	public function getEmployeeNew()
	{
		return view('employees::edit_employee_details', [
				'employee' => null,
				'employee_positions' => $this->employeeRepository->getEmployeePositions()->get(),
				'employee_departments' => $this->employeeRepository->getEmployeeDepartments()->get(),
				'employee_grades' => $this->employeeRepository->getEmployeeGrades()->get(),
				'employee_form_validator' => $this->jsValidator(CreateEmployeeDetailsRequest::class)
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
				'employee' => $this->employeeRepository->findEmployee($id),
				'employee_positions' => $this->employeeRepository->getEmployeePositions()->get(),
				'employee_departments' => $this->employeeRepository->getEmployeeDepartments()->get(),
				'employee_grades' => $this->employeeRepository->getEmployeeGrades()->get(),
				'employee_form_validator' => $this->jsValidator(UpdateEmployeeDetailsRequest::class)
			]);
	}

	public function postEmployeeDetailsEdit(UpdateEmployeeDetailsRequest $request, $id)
	{
		$employee = $this->employeeRepository->updateEmployee($request->all(), $id);

		return $this->printJson(true, [], trans('employees::employee.employee_updated'));
	}

	public function getEmployeeList(EmployeeListCriteria $criteria)
	{
		return view('employees::employee_list', [
				'employees' => $this->employeeRepository->getEmployees($criteria)->paginate(),
				'criteria' => $criteria
			]);
	}

	public function __construct(EmployeeRepository $employeeRepository)
	{
		$this->employeeRepository = $employeeRepository;
	}
}
