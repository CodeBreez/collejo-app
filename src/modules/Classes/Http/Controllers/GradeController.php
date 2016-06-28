<?php 

namespace Collejo\App\Modules\Classes\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\ClassRepository;

class GradeController extends BaseController
{

	protected $classRepository;

	public function getNew()
	{
		return $this->printModal(view('classes::modals.edit_grade', ['grade' => null]));
	}

	public function getList()
	{
		return view('classes::grades_list', ['grades' => $this->classRepository->getBatches()]);
	}

	public function __construct(ClassRepository $classRepository)
	{
		$this->classRepository = $classRepository;
	}
}
