<?php

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Employees\Contracts\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeGradeRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeGradeRequest;

class EmployeeGradeController extends Controller
{
    protected $employeeRepository;

    /**
     * Get new grade form.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeGradeNew()
    {
        $this->authorize('add_edit_employee_grade');

        return view('employees::edit_employee_grade_details', [
            'employee_grade'       => null,
            'grade_form_validator' => $this->jsValidator(CreateEmployeeGradeRequest::class),
        ]);
    }

    /**
     * Save new employee grade.
     *
     * @param CreateEmployeeGradeRequest $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEmployeeGradeNew(CreateEmployeeGradeRequest $request)
    {
        $this->authorize('add_edit_employee_grade');

        $employeeGrade = $this->employeeRepository->createEmployeeGrade($request->all());

        return $this->printRedirect(route('employee_grade.details.edit', $employeeGrade->id),
            trans('employees::employee_grade.employee_grade_created'));
    }

    /**
     * Get employee grade edit form.
     *
     * @param $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeGradeEdit($id)
    {
        $this->authorize('add_edit_employee_grade');

        return view('employees::edit_employee_grade_details', [
            'employee_grade'       => $this->employeeRepository->findEmployeeGrade($id),
            'grade_form_validator' => $this->jsValidator(UpdateEmployeeGradeRequest::class),
        ]);
    }

    /**
     * Save employee grade.
     *
     * @param UpdateEmployeeGradeRequest $request
     * @param $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEmployeeGradeEdit(UpdateEmployeeGradeRequest $request, $id)
    {
        $this->authorize('add_edit_employee_grade');

        $this->employeeRepository->updateEmployeeGrade($request->all(), $id);

        return $this->printJson(true, [], trans('employees::employee_grade.employee_grade_updated'));
    }

    /**
     * Get list of employee grades.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeGradeList()
    {
        $this->authorize('list_employee_grades');

        return view('employees::employee_grade_list', [
            'employee_grades' => $this->employeeRepository
                ->getEmployeeGrades()
                ->paginate(config('collejo.pagination.perpage')),
        ]);
    }

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
}
