<?php 

namespace Collejo\App\Modules\Classes\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\ClassRepository;
use Collejo\App\Modules\Classes\Http\Requests\CreateClassRequest;

class ClassController extends BaseController
{

	protected $classRepository;

	public function postNew(CreateClassRequest $request)
	{
		$batch = $this->classRepository->createClass($request->all());

		return $this->printRedirect(route('classes.class.edit.detail', $batch->id));
	}

	public function getNew()
	{
		return view('classes::edit_class', ['batch' => null]);
	}

	public function getList()
	{
		return view('classes::classes_list', ['classes' => $this->classRepository->getClasses()]);
	}

	public function __construct(ClassRepository $classRepository)
	{
		$this->classRepository = $classRepository;
	}
}
