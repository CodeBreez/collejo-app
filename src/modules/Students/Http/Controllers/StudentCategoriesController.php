<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\StudentRepository;

class StudentCategoriesController  extends BaseController
{

	protected $studentRepository;

	public function getStudentCategoriesList()
	{
		return view('students::student_categories_list', ['student_categories' => $this->studentRepository->getStudentCategories()]);
	}

	public function __construct(StudentRepository $studentRepository)
	{
		$this->studentRepository = $studentRepository;
	}
}
