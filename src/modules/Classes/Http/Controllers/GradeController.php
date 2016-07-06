<?php 

namespace Collejo\App\Modules\Classes\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\ClassRepository;
use Collejo\App\Modules\Classes\Http\Requests\CreateGradeRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateGradeRequest;

class GradeController extends BaseController
{

	protected $classRepository;

	public function postEdit(UpdateGradeRequest $request, $gradeId)
	{
		$this->classRepository->updateGrade($request->all(), $gradeId);

		return $this->printJson(true, [], 'Grade Updated');
	}

	public function getEdit($gradeId)
	{
		return view('classes::edit_grade', ['grade' => $this->classRepository->findGrade($gradeId)]);
	}

	public function postNew(CreateGradeRequest $request)
	{
		$grade = $this->classRepository->createGrade($request->all());

		return $this->printRedirect(route('classes.grade.edit.detail', $grade->id));
	}

	public function getNew()
	{
		return view('classes::edit_grade', ['grade' => null]);
	}

	public function getList()
	{
		return view('classes::grades_list', ['grades' => $this->classRepository->getGrades()]);
	}

	public function __construct(ClassRepository $classRepository)
	{
		$this->classRepository = $classRepository;
	}
}
