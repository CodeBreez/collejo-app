<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\StudentRepository;
use Collejo\App\Modules\Students\Http\Requests\CreateStudentRequest;

class StudentController extends BaseController
{

	protected $studentRepository;

	public function getStudentDetails($studentId)
	{
		return view('students::edit_details', ['student' => $this->studentRepository->find($studentId)])->render();
	}	

	public function getStudentContacts($studentId)
	{
		return view('students::edit_contacts', ['student' => $this->studentRepository->find($studentId)])->render();
	}	

	public function getList()
	{
		return view('students::list')->render();
	}

	public function postNew(CreateStudentRequest $request)
	{
		$student = $this->studentRepository->create($request->all());
	}

	public function getNew()
	{
		return view('students::edit_details', ['student' => null])->render();
	}

	public function __construct(StudentRepository $studentRepository)
	{
		$this->studentRepository = $studentRepository;
	}
}
