<?php 

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeCategoryRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeCategoryRequest;

class EmployeeCategoryController extends BaseController
{

	protected $employeeRepository;

	public function getEmployeeCategoryNew()
	{
		return $this->printModal(view('employees::modals.edit_employee_category', [
						'employee_category' => null
					]));
	}

	public function postEmployeeCategoryNew(CreateEmployeeCategoryRequest $request)
	{
		return $this->printPartial(view('employees::partials.employee_category', [
						'employee_category' => $this->employeeRepository->createEmployeeCategory($request->all()),
					]), trans('employees::employee_category.employee_category_created'));
	}

	public function getEmployeeCategoryEdit($id)
	{
		return $this->printModal(view('employees::modals.edit_employee_category', [
						'employee_category' => $this->employeeRepository->findEmployeeCategory($id)
					]));
	}

	public function postEmployeeCategoryEdit(UpdateEmployeeCategoryRequest $request, $id)
	{
		return $this->printPartial(view('employees::partials.employee_category', [
						'employee_category' => $this->employeeRepository->updateEmployeeCategory($request->all(), $id),
					]), trans('employees::employee_category.employee_category_updated'));
	}

	public function getEmplyeeCategoryList()
	{
		return view('employees::employee_category_list', ['employee_categories' => $this->employeeRepository->getEmployeeCategories()]);
	}

	public function __construct(EmployeeRepository $employeeRepository)
	{
		$this->employeeRepository = $employeeRepository;
	}
}
