<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\StudentRepository;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentCategoryRequest;
use Collejo\App\Modules\Students\Http\Requests\CreateStudentCategoryRequest;

class StudentCategoryController  extends BaseController
{

	protected $studentRepository;

	public function getStudentCategoryNew()
	{
		$this->authorize('add_edit_student_category');

		return $this->printModal(view('students::modals.edit_student_category', [
				'student_category' => null,
				'category_form_validator' => $this->jsValidator(CreateStudentCategoryRequest::class)
			]));
	}

	public function postStudentCategoryNew(CreateStudentCategoryRequest $request)
	{
		$this->authorize('add_edit_student_category');


		return $this->printPartial(view('students::partials.student_category', [
				'student_category' => $this->studentRepository->createStudentCategory($request->all()),
			]), trans('students::student_category.student_category_created'));
	}

	public function getStudentCategoryEdit($id)
	{
		$this->authorize('add_edit_student_category');

		return $this->printModal(view('students::modals.edit_student_category', [
				'student_category' => $this->studentRepository->findStudentCategory($id),
				'category_form_validator' => $this->jsValidator(UpdateStudentCategoryRequest::class)
			]));
	}

	public function postStudentCategoryEdit(UpdateStudentCategoryRequest $request, $id)
	{
		$this->authorize('add_edit_student_category');

		return $this->printPartial(view('students::partials.student_category', [
				'student_category' => $this->studentRepository->updateStudentCategory($request->all(), $id),
			]), trans('students::student_category.student_category_updated'));
	}

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
