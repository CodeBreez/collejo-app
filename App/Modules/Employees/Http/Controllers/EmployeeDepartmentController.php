<?php

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Employees\Contracts\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeDepartmentRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeDepartmentRequest;

class EmployeeDepartmentController extends Controller
{
    protected $employeeRepository;

    /**
     * Get new employee department form.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeDepartmentNew()
    {
        $this->authorize('add_edit_employee_department');

        return view('employees::edit_employee_department_details', [
            'employee_department'       => null,
            'department_form_validator' => $this->jsValidator(CreateEmployeeDepartmentRequest::class),
        ]);
    }

    /**
     * Save new employee department.
     *
     * @param CreateEmployeeDepartmentRequest $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEmployeeDepartmentNew(CreateEmployeeDepartmentRequest $request)
    {
        $this->authorize('add_edit_employee_department');

        $employeeDepartment = $this->employeeRepository->createEmployeeDepartment($request->all());

        return $this->printRedirect(route('employee_department.details.edit', $employeeDepartment->id),
            trans('employees::employee_department.employee_department_created'));
    }

    /**
     * Get employee department edit form.
     *
     * @param $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeDepartmentEdit($id)
    {
        $this->authorize('add_edit_employee_department');

        return view('employees::edit_employee_department_details', [
            'employee_department'       => $this->employeeRepository->findEmployeeDepartment($id),
            'department_form_validator' => $this->jsValidator(UpdateEmployeeDepartmentRequest::class),
        ]);
    }

    /**
     * Save employee department form.
     *
     * @param UpdateEmployeeDepartmentRequest $request
     * @param $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEmployeeDepartmentEdit(UpdateEmployeeDepartmentRequest $request, $id)
    {
        $this->authorize('add_edit_employee_department');

        $this->employeeRepository->updateEmployeeDepartment($request->all(), $id);

        return $this->printJson(true, [], trans('employees::employee_department.employee_department_updated'));
    }

    /**
     * Get employee departments list.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeDepartmentList()
    {
        $this->authorize('list_employee_departments');

        return view('employees::employee_department_list', [
            'employee_departments' => $this->employeeRepository
                ->getEmployeeDepartments()
                ->paginate(config('collejo.pagination.perpage')),
        ]);
    }

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
}
