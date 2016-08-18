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
		return $this->printModal(view('students::modals.edit_student_category', [
						'student_category' => null
					]));
	}

	public function postStudentCategoryNew(CreateStudentCategoryRequest $request)
	{
		return $this->printPartial(view('students::partials.student_category', [
						'student_category' => $this->studentRepository->createStudentCategory($request->all()),
					]), trans('students::student_category.student_category_created'));
	}

	public function getStudentCategoryEdit($id)
	{
		return $this->printModal(view('students::modals.edit_student_category', [
						'student_category' => $this->studentRepository->findStudentCategory($id)
					]));
	}

	public function postStudentCategoryEdit(UpdateStudentCategoryRequest $request, $id)
	{
		return $this->printPartial(view('students::partials.student_category', [
						'student_category' => $this->studentRepository->updateStudentCategory($request->all(), $id),
					]), trans('students::student_category.student_category_updated'));
	}

	public function getStudentCategoriesList()
	{
		return view('students::student_categories_list', [
					'student_categories' => $this->studentRepository->getStudentCategories()->paginate()
				]);
	}

	public function __construct(StudentRepository $studentRepository)
	{
		$this->studentRepository = $studentRepository;
	}
}
