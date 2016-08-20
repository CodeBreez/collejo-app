<?php 

namespace Collejo\App\Modules\Classes\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\ClassRepository;
use Collejo\App\Modules\Classes\Http\Requests\CreateGradeRequest;
use Collejo\App\Modules\Classes\Http\Requests\CreateClassRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateGradeRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateClassRequest;
use Request;

class GradeController extends BaseController
{

	protected $classRepository;

	public function getGradeClassDelete($gradeId, $classId)
	{
		$this->classRepository->deleteClass($classId, $gradeId);

		return $this->printJson(true, [], trans('classes::class.class_deleted'));
	}

	public function postGradeClassEdit(UpdateClassRequest $request, $gradeId, $classId)
	{
		$class = $this->classRepository->updateClass($request->all(), $classId, $gradeId);

		return $this->printPartial(view('classes::partials.class', [
				'grade' => $this->classRepository->findGrade($gradeId),
				'class' => $class
			]), trans('classes::class.class_updated'));
	}

	public function getGradeClassEdit($gradeId, $classId)
	{
		return $this->printModal(view('classes::modals.edit_class', [
				'class' => $this->classRepository->findClass($classId, $gradeId),
				'grade' => $this->classRepository->findGrade($gradeId),
				'class_form_validator' => $this->jsValidator(UpdateClassRequest::class)
			]));
	}

	public function postGradeClassNew(CreateClassRequest $request, $gradeId)
	{
		$class = $this->classRepository->createClass($request->all(), $gradeId);

		return $this->printPartial(view('classes::partials.class', [
				'grade' => $this->classRepository->findGrade($gradeId),
				'class' => $class
			]), 'Class Created');
	}

	public function getGradeClassNew($gradeId)
	{
		return $this->printModal(view('classes::modals.edit_class', [
				'class' => null,
				'grade' => $this->classRepository->findGrade($gradeId),
				'class_form_validator' => $this->jsValidator(CreateClassRequest::class)
			]));
	}

	public function getGradeDetailsView($gradeId)
	{
		return view('classes::view_grade_details', ['grade' => $this->classRepository->findGrade($gradeId)]);
	}

	public function getGradeClassesView($gradeId)
	{
		return view('classes::view_grade_classes', ['grade' => $this->classRepository->findGrade($gradeId)]);
	}

	public function getGradeClassesEdit($gradeId)
	{
		return view('classes::edit_grade_classes', ['grade' => $this->classRepository->findGrade($gradeId)]);
	}

	public function postGradeDetailsEdit(UpdateGradeRequest $request, $gradeId)
	{
		$this->classRepository->updateGrade($request->all(), $gradeId);

		return $this->printJson(true, [], trans('classes::grade.grade_updated'));
	}

	public function getGradeDetailsEdit($gradeId)
	{
		return view('classes::edit_grade_details', [
				'grade' => $this->classRepository->findGrade($gradeId),
				'grade_form_validator' => $this->jsValidator(UpdateGradeRequest::class)
			]);
	}

	public function postGradeNew(CreateGradeRequest $request)
	{
		$grade = $this->classRepository->createGrade($request->all());

		return $this->printRedirect(route('grade.classes.edit', $grade->id));
	}

	public function getGradeNew()
	{
		return view('classes::edit_grade_details', [
				'grade' => null,
				'grade_form_validator' => $this->jsValidator(CreateGradeRequest::class)
			]);
	}

	public function getGradeList(Request $request)
	{
		return view('classes::grades_list', [
				'grades' => $this->classRepository->getGrades()->paginate(config('collejo.pagination.perpage'))
			]);
	}

	public function getGradeClasses(Request $request)
	{
		return $this->printJson(true, $this->classRepository->findGrade($request::get('grade_id'))->classes->pluck('name', 'id'));
	}

	public function __construct(ClassRepository $classRepository)
	{
		$this->classRepository = $classRepository;
	}
}
