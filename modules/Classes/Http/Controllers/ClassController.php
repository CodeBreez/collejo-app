<?php 

namespace Collejo\App\Modules\Classes\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\ClassRepository;

class ClassController extends BaseController
{

	protected $classRepository;

	public function getNew()
	{
		return $this->printModal(view('classes::modals.edit_class', ['class' => null]));
	}

	public function getList()
	{
		return view('classes::classes_list', ['classes' => $this->classRepository->getBatches()]);
	}

	public function __construct(ClassRepository $classRepository)
	{
		$this->classRepository = $classRepository;
	}
}
