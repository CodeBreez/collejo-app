<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\StudentRepository;
use Collejo\App\Modules\Students\Http\Requests\CreateStudentRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentRequest;

class StudentController extends BaseController
{

	protected $studentRepository;

	public function getStudentContactsNew($studentId)
	{
		return $this->printModal(view('students::modals.edit_contact', [
				'contact' => null,
				'student' => $this->studentRepository->find($studentId)
			]));
	}

	public function getStudentDetails($studentId)
	{
		return view('students::edit_details', ['student' => $this->studentRepository->find($studentId)]);
	}	

	public function postStudentDetails(UpdateStudentRequest $request, $studentId)
	{
		$this->studentRepository->update($request->all(), $studentId);

		return $this->printJson(true, [], 'Student updated');
	}	

	public function getStudentContacts($studentId)
	{
		return view('students::edit_contacts', ['student' => $this->studentRepository->find($studentId)]);
	}		

	public function getStudentAccount($studentId)
	{
		return view('students::edit_account', ['student' => $this->studentRepository->find($studentId)]);
	}	

	public function getList()
	{
		return view('students::list', [
				'students' => $this->studentRepository->getStudents()->paginate()
			]);
	}

	public function postNew(CreateStudentRequest $request)
	{
		$student = $this->studentRepository->create($request->all());

		return $this->printRedirect(route('students.edit.details', $student->id));
	}

	public function getNew()
	{
		return view('students::edit_details', ['student' => null]);
	}

	public function __construct(StudentRepository $studentRepository)
	{
		$this->studentRepository = $studentRepository;
	}
}
