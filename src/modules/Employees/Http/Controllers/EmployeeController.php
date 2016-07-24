<?php 

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends BaseController
{

	protected $employeeRepository;

	public function getEmplyeeList()
	{
		return view('employees::employee_list', ['employees' => $this->employeeRepository->getEmployees()->paginate()]);
	}

	public function __construct(EmployeeRepository $employeeRepository)
	{
		$this->employeeRepository = $employeeRepository;
	}
}
