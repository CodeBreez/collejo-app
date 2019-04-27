<?php

namespace Collejo\App\Modules\Employees\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Employees\Contracts\EmployeeRepository;
use Collejo\App\Modules\Employees\Http\Requests\CreateEmployeeCategoryRequest;
use Collejo\App\Modules\Employees\Http\Requests\UpdateEmployeeCategoryRequest;

class EmployeeCategoryController extends Controller
{
    protected $employeeRepository;

    /**
     * Get new employee category form.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeCategoryNew()
    {
        $this->authorize('add_edit_employee_category');

        return view('employees::edit_employee_category_details', [
            'employee_category'       => null,
            'category_form_validator' => $this->jsValidator(UpdateEmployeeCategoryRequest::class),
        ]);
    }

    /**
     * Get employee category form.
     *
     * @param CreateEmployeeCategoryRequest $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEmployeeCategoryNew(CreateEmployeeCategoryRequest $request)
    {
        $this->authorize('add_edit_employee_category');

        $employeeCategory = $this->employeeRepository->createEmployeeCategory($request->all());

        return $this->printRedirect(route('employee_category.details.edit', $employeeCategory->id),
            trans('employees::employee_category.employee_category_created'));
    }

    /**
     * Get employee category form.
     *
     * @param $id
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeCategoryEdit($id)
    {
        $this->authorize('add_edit_employee_category');

        return view('employees::edit_employee_category_details', [
            'employee_category'       => $this->employeeRepository->findEmployeeCategory($id),
            'category_form_validator' => $this->jsValidator(UpdateEmployeeCategoryRequest::class),
        ]);
    }

    /**
     * Save employee category
     *
     * @param UpdateEmployeeCategoryRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function postEmployeeCategoryEdit(UpdateEmployeeCategoryRequest $request, $id)
    {
        $this->authorize('add_edit_employee_category');

        $this->employeeRepository->updateEmployeeCategory($request->all(), $id);

        return $this->printJson(true, [], trans('employees::employee_category.employee_category_updated'));
    }

    /**
     * List employee categories.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEmployeeCategoryList()
    {
        $this->authorize('list_employee_categories');

        return view('employees::employee_category_list', [
            'employee_categories' => $this->employeeRepository
                ->getEmployeeCategories()
                ->paginate(config('collejo.pagination.perpage')),
        ]);
    }

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
}
