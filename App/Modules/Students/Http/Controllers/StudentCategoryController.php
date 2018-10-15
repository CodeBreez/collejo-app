<?php

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Students\Contracts\StudentRepository;
use Collejo\App\Modules\Students\Http\Requests\CreateStudentCategoryRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentCategoryRequest;

class StudentCategoryController  extends Controller
{

	protected $studentRepository;

    /**
     * Return new Student Category view
     *
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function getStudentCategoryNew()
	{
		$this->authorize('add_edit_student_category');

		return $this->printModal(view('students::modals.edit_student_category', [
				'student_category' => null,
				'category_form_validator' => $this->jsValidator(CreateStudentCategoryRequest::class)
			]));
	}

    /**
     * Save new Student Category
     *
     * @param CreateStudentCategoryRequest $request
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function postStudentCategoryNew(CreateStudentCategoryRequest $request)
	{
		$this->authorize('add_edit_student_category');

		return $this->printPartial(view('students::partials.student_category', [
				'student_category' => $this->studentRepository->createStudentCategory($request->all()),
			]), trans('students::student_category.student_category_created'));
	}

    /**
     * Edit Student Category
     *
     * @param $id
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function getStudentCategoryEdit($id)
	{
		$this->authorize('add_edit_student_category');

		return $this->printModal(view('students::modals.edit_student_category', [
				'student_category' => $this->studentRepository->findStudentCategory($id),
				'category_form_validator' => $this->jsValidator(UpdateStudentCategoryRequest::class)
			]));
	}

    /**
     * Save Student Category
     *
     * @param UpdateStudentCategoryRequest $request
     * @param $id
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function postStudentCategoryEdit(UpdateStudentCategoryRequest $request, $id)
	{
		$this->authorize('add_edit_student_category');

		return $this->printPartial(view('students::partials.student_category', [
				'student_category' => $this->studentRepository->updateStudentCategory($request->all(), $id),
			]), trans('students::student_category.student_category_updated'));
	}

    /**
     * Get Student Categories list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
	public function getStudentCategoriesList()
	{
		$this->authorize('list_student_categories');

		return view('students::student_categories_list', [
				'student_categories' => $this->studentRepository->getStudentCategories()->paginate(config('collejo.pagination.perpage'))
			]);
	}

	public function __construct(StudentRepository $studentRepository)
	{
		$this->studentRepository = $studentRepository;
	}
}
