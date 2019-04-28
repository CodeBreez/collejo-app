<?php

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\ACL\Http\Requests\UpdateUserAccountRequest;
use Collejo\App\Modules\ACL\Presenters\UserAccountPresenter;
use Collejo\App\Modules\Employees\Contracts\EmployeeRepository;
use Collejo\App\Modules\Employees\Criteria\EmployeeListCriteria;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeDetailsRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeAccountRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeDetailsRequest;
use Collejo\App\Modules\Employees\Presenters\EmployeeDetailsPresenter;
use Collejo\App\Modules\Employees\Presenters\EmployeeListPresenter;

class EmployeeController extends Controller
{
    protected $employeeRepository;

    /**
     * View employee details.
     *
     * @param $employeeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeDetailsView($employeeId)
    {
        $this->authorize('view_employee_general_details');

        return view('employees::view_employee_details', [
            'employee' => $this->employeeRepository->findEmployee($employeeId),
        ]);
    }

    /**
     * Get employee account view.
     *
     * @param $employeeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeAccountView($employeeId)
    {
        $this->authorize('view_user_account_info');

        $this->middleware('reauth');

        $employee = $this->employeeRepository->findEmployee($employeeId);

        return view('employees::view_employee_account', [
                'employee' => $employee,
                'user' => present($employee->user, UserAccountPresenter::class),
            ]);
    }

    /**
     * Get account edit form.
     *
     * @param $employeeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeAccountEdit($employeeId)
    {
        $this->authorize('edit_user_account_info');

        $this->middleware('reauth');

        $employee = $this->employeeRepository->findEmployee($employeeId);

        return view('employees::edit_employee_account', [
            'employee'            => $employee,
            'user'                => present($employee->user, UserAccountPresenter::class),
            'user_form_validator' => $this->jsValidator(UpdateUserAccountRequest::class),
        ]);
    }

    /**
     * Post account edit form.
     *
     * @param UpdateUserAccountRequest $request
     * @param $employeeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEmployeeAccountEdit(UpdateUserAccountRequest $request, $employeeId)
    {
        $this->authorize('edit_user_account_info');

        $this->middleware('reauth');

        $this->employeeRepository->updateEmployee($request->all(), $employeeId);

        return $this->printJson(true, [], trans('employees::employee.employee_updated'));
    }

    /**
     * Get new employee form.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeNew()
    {
        $this->authorize('create_employee');

        return view('employees::edit_employee_details', [
                'employee'                => null,
                'employee_positions'      => $this->employeeRepository->getEmployeePositions()->get(),
                'employee_departments'    => $this->employeeRepository->getEmployeeDepartments()->get(),
                'employee_grades'         => $this->employeeRepository->getEmployeeGrades()->get(),
                'employee_form_validator' => $this->jsValidator(CreateEmployeeDetailsRequest::class),
            ]);
    }

    /**
     * Post create employee form.
     *
     * @param CreateEmployeeDetailsRequest $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEmployeeNew(CreateEmployeeDetailsRequest $request)
    {
        $this->authorize('create_employee');

        $employee = $this->employeeRepository->createEmployee($request->all());

        return $this->printRedirect(route('employee.details.edit', $employee->id), trans('employees::employee.employee_created'));
    }

    /**
     * Get save employee form.
     *
     * @param $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeDetailsEdit($id)
    {
        $this->authorize('edit_employee_general_details');

        return view('employees::edit_employee_details', [
                'employee'                => present($this->employeeRepository->findEmployee($id), EmployeeDetailsPresenter::class),
                'employee_positions'      => $this->employeeRepository->getEmployeePositions()->get(),
                'employee_departments'    => $this->employeeRepository->getEmployeeDepartments()->get(),
                'employee_grades'         => $this->employeeRepository->getEmployeeGrades()->get(),
                'employee_form_validator' => $this->jsValidator(UpdateEmployeeDetailsRequest::class),
            ]);
    }

    /**
     * Save employee details.
     *
     * @param UpdateEmployeeDetailsRequest $request
     * @param $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEmployeeDetailsEdit(UpdateEmployeeDetailsRequest $request, $id)
    {
        $this->authorize('edit_employee_general_details');

        $employee = $this->employeeRepository->updateEmployee($request->all(), $id);

        return $this->printJson(true, [], trans('employees::employee.employee_updated'));
    }

    /**
     * Returns the employees list.
     *
     * @param EmployeeListCriteria $criteria
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeList(EmployeeListCriteria $criteria)
    {
        $this->authorize('list_employees');

        return view('employees::employee_list', [
            'criteria'  => $criteria,
            'employees' => present($this->employeeRepository->getEmployees($criteria)->paginate(), EmployeeListPresenter::class),
        ]);
    }

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
}
