<?php 

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeRequest;

class EmployeeGradeController extends BaseController
{

	protected $employeeRepository;

	public function getEmployeeGradeNew()
	{
		return $this->printModal(view('employees::modals.edit_employee_grade', [
						'employee_grade' => null
					]));
	}

	public function postEmployeeGradeNew(CreateEmployeeGradeRequest $request)
	{
		return $this->printPartial(view('employees::partials.employee_grade', [
						'employee_grade' => $this->employeeRepository->createEmployeeGrade($request->all()),
					]), trans('employees::employee_grade.employee_grade_created'));
	}

	public function getEmployeeGradeEdit($id)
	{
		return $this->printModal(view('employees::modals.edit_employee_grade', [
						'employee_grade' => $this->employeeRepository->findEmployeeGrade($id)
					]));
	}

	public function postEmployeeGradeEdit(UpdateEmployeeGradeRequest $request, $id)
	{
		return $this->printPartial(view('employees::partials.employee_grade', [
						'employee_grade' => $this->employeeRepository->updateEmployeeGrade($request->all(), $id),
					]), trans('employees::employee_grade.employee_grade_updated'));
	}

	public function getEmplyeeDepartmentList()
	{
		return view('employees::employee_grade_list', ['employee_grades' => $this->employeeRepository->getEmployeeGrades()]);
	}

	public function __construct(EmployeeRepository $employeeRepository)
	{
		$this->employeeRepository = $employeeRepository;
	}
}
