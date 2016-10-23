<?php 

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeDetailsRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeDetailsRequest;
use Collejo\App\Modules\Employees\Http\Requests\CreateAddressRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateAddressRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeAccountRequest;
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

	public function getEmployeeAddressesView($employeeId)
	{
		$this->authorize('view_employee_contact_details');

		return view('employees::view_employee_addreses', ['employee' => $this->employeeRepository->findEmployee($employeeId)]);
	}

	public function getEmployeeAddressesEdit($employeeId)
	{
		$this->authorize('edit_employee_contact_details');
		
		return view('employees::edit_employee_addreses', ['employee' => $this->employeeRepository->findEmployee($employeeId)]);
	}

	public function getEmployeeAddressNew($employeeId)
	{
        return $this->printModal(view('employees::modals.edit_address', [
                'address' => null,
                'employee' => $this->employeeRepository->findEmployee($employeeId)
            ]));
	}

	public function postEmployeeAddressNew(CreateAddressRequest $request, $employeeId)
	{
        $address = $this->employeeRepository->createAddress($request->all(), $employeeId);

        return $this->printPartial(view('employees::partials.address', [
                'employee' => $this->employeeRepository->findEmployee($employeeId),
                'address' => $address
            ]), trans('employees::address.address_created'));
	}

	public function getEmployeeAddressEdit($employeeId)
	{

	}

	public function postEmployeeAddressEdit(UpdateAddressRequest $request, $employeeId)
	{

	}

	public function getEmployeeAddressDelete($employeeId)
	{

	}

	public function getEmployeeAccountView($employeeId)
	{
		$this->authorize('view_user_account_info');

		$this->middleware('reauth');

		return view('employees::view_employee_account', [
				'employee' => $this->employeeRepository->findEmployee($employeeId)
			]);
	}

	public function getEmployeeAccountEdit($employeeId)
	{
		$this->authorize('edit_user_account_info');
		
		$this->middleware('reauth');

		return view('employees::edit_employee_account', [
				'employee' => $this->employeeRepository->findEmployee($employeeId),
				'account_form_validator' => $this->jsValidator(UpdateEmployeeAccountRequest::class)
			]);		
	}

	public function postEmployeeAccountEdit(UpdateEmployeeAccountRequest $request, $employeeId)
	{
		$this->authorize('edit_user_account_info');

		$this->middleware('reauth');

		$this->employeeRepository->updateEmployee($request->all(), $employeeId);

		return $this->printJson(true, [], trans('employees::employee.employee_updated'));		
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
		$employee = $this->employeeRepository->createEmployee($request->all());

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
				'employees' => $this->employeeRepository->getEmployees($criteria)
									->with('user', 'employeeDepartment', 'employeePosition', 'employeeGrade')
									->paginate(),
				'criteria' => $criteria
			]);
	}

	public function __construct(EmployeeRepository $employeeRepository)
	{
		$this->employeeRepository = $employeeRepository;
	}
}
