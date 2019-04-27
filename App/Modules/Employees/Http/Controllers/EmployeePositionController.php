<?php

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Employees\Contracts\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeePositionRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeePositionRequest;

class EmployeePositionController extends Controller
{
    protected $employeeRepository;

    /**
     * Get new employee position form.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     *
     * @return mixed
     */
    public function getEmployeePositionNew()
    {
        $this->authorize('add_edit_employee_position');

        return view('employees::edit_employee_position_details', [
            'employee_position'       => null,
            'position_form_validator' => $this->jsValidator(CreateEmployeePositionRequest::class),
            'employee_categories'     => $this->employeeRepository->getEmployeeCategories()->get(),
        ]);
    }

    /**
     * Save new employee position.
     *
     * @param CreateEmployeePositionRequest $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return mixed
     */
    public function postEmployeePositionNew(CreateEmployeePositionRequest $request)
    {
        $this->authorize('add_edit_employee_position');

        $employeePosition = $this->employeeRepository->createEmployeePosition($request->all());

        return $this->printRedirect(route('employee_position.details.edit', $employeePosition->id),
            trans('employees::employee_position.employee_position_created'));
    }

    /**
     * Get employee position form.
     *
     * @param $id
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function getEmployeePositionEdit($id)
    {
        $this->authorize('add_edit_employee_position');

        return view('employees::edit_employee_position_details', [
            'employee_position'       => $this->employeeRepository->findEmployeePosition($id),
            'position_form_validator' => $this->jsValidator(CreateEmployeePositionRequest::class),
            'employee_categories'     => $this->employeeRepository->getEmployeeCategories()->get(),
        ]);
    }

    /**
     * Post employee position data.
     *
     * @param UpdateEmployeePositionRequest $request
     * @param $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return mixed
     */
    public function postEmployeePositionEdit(UpdateEmployeePositionRequest $request, $id)
    {
        $this->authorize('add_edit_employee_position');

        $this->employeeRepository->updateEmployeePosition($request->all(), $id);

        return $this->printJson(true, [], trans('employees::employee_position.employee_position_updated'));
    }

    /**
     * Get a list of employee positions.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeePositionList()
    {
        $this->authorize('add_edit_employee_position');

        return view('employees::employee_position_list', [
                        'employee_positions' => $this->employeeRepository
                            ->getEmployeePositions()
                            ->with('employeeCategory')
                            ->paginate(config('collejo.pagination.perpage')),
                    ]);
    }

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
}
