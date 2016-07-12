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

		return $this->printJson(true, [], 'Class Deleted');
	}

	public function postGradeClassEdit(UpdateClassRequest $request, $gradeId, $classId)
	{
		$class = $this->classRepository->updateClass($request->all(), $classId, $gradeId);

		return $this->printPartial(view('classes::partials.class', [
				'grade' => $this->classRepository->findGrade($gradeId),
				'class' => $class
			]), 'Class Updated');
	}

	public function getGradeClassEdit($gradeId, $classId)
	{
		return $this->printModal(view('classes::modals.edit_class', [
				'class' => $this->classRepository->findClass($classId, $gradeId),
				'grade' => $this->classRepository->findGrade($gradeId)
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
				'grade' => $this->classRepository->findGrade($gradeId)
			]));
	}

	public function getGradeClassesView($gradeId)
	{
		return view('classes::view_grade_classes', ['grade' => $this->classRepository->findGrade($gradeId)]);
	}

	public function postGradeDetailsEdit(UpdateGradeRequest $request, $gradeId)
	{
		$this->classRepository->updateGrade($request->all(), $gradeId);

		return $this->printJson(true, [], 'Grade Updated');
	}

	public function getGradeDetailsEdit($gradeId)
	{
		return view('classes::edit_grade', ['grade' => $this->classRepository->findGrade($gradeId)]);
	}

	public function postGradeNew(CreateGradeRequest $request)
	{
		$grade = $this->classRepository->createGrade($request->all());

		return $this->printRedirect(route('grade.details.edit', $grade->id));
	}

	public function getGradeNew()
	{
		return view('classes::edit_grade', ['grade' => null]);
	}

	public function getGradeList(Request $request)
	{
		return view('classes::grades_list', ['grades' => $this->classRepository->getGrades()]);
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
