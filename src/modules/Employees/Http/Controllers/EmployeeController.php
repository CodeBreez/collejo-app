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
						'employee_categories' => $this->employeeRepository->getEmployeeCategories()
					]);
	}

	public function postEmployeeNew(CreateEmployeeDetailsRequest $request)
	{

	}

	public function getEmployeeDetailsEdit($id)
	{
		return view('employees::edit_employee_details', [
						'employee' => $this->employeeRepository->findEmployee($id),
						'employee_categories' => $this->employeeRepository->getEmployeeCategories()
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
