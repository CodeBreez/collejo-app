<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\StudentRepository;
use Collejo\App\Repository\ClassRepository;
use Collejo\App\Modules\Students\Http\Requests\CreateStudentRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentRequest;
use Collejo\App\Modules\Students\Http\Requests\CreateAddressRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateAddressRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentAccountRequest;
use Collejo\App\Modules\Students\Http\Requests\AssignClassRequest;
use Collejo\App\Modules\Students\Http\Requests\AssignGuardianRequest;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;

class StudentController extends BaseController
{

	protected $studentRepository;
	
	protected $classRepository;

	public function postStudentClassAssign(AssignClassRequest $request, $studentId)
	{
		$this->authorize('assign_student_to_class');

		$this->studentRepository->assignToClass($request->get('batch_id'),  $request->get('grade_id'), $request->get('class_id'), $studentId);

		return $this->printPartial(view('students::partials.student', [
				'student' => $this->studentRepository->findStudent($studentId),
			]), trans('students::student.student_updated'));
	}

	public function getStudentClassAssign($studentId)
	{
		$this->authorize('assign_student_to_class');

		return $this->printModal(view('students::modals.assign_class', [
				'student' => $this->studentRepository->findStudent($studentId),
				'batches' => $this->classRepository->activeBatches()->get(),
				'assign_form' => $this->jsValidator(AssignClassRequest::class)
			]));
	}

	public function postStudentGuardianAssign(AssignGuardianRequest $request, $studentId)
	{
		$this->authorize('assign_guardian_to_student');

		$this->studentRepository->assignGuardian($request->get('guardian_id'), $studentId);

		return $this->printPartial(view('students::partials.student', [
				'student' => $this->studentRepository->findStudent($studentId),
			]), trans('students::student.student_updated'));
	}

	public function getStudentGuardianAssign($studentId)
	{
		$this->authorize('assign_guardian_to_student');

		return $this->printModal(view('students::modals.assign_guardian', [
				'student' => $this->studentRepository->findStudent($studentId),
				'assign_form' => $this->jsValidator(AssignGuardianRequest::class)
			]));		
	}

	public function getStudentDetailEdit($studentId)
	{
		$this->authorize('edit_student_general_details');

		return view('students::edit_student_details', [
				'student' => $this->studentRepository->findStudent($studentId),
				'student_categories' => $this->studentRepository->getStudentCategories()->paginate(),
				'student_form_validator' => $this->jsValidator(UpdateStudentRequest::class)
			]);
	}	

	public function postStudentDetailEdit(UpdateStudentRequest $request, $studentId)
	{
		$this->authorize('edit_student_general_details');

		$this->studentRepository->updateStudent($request->all(), $studentId);

		return $this->printJson(true, [], trans('students::student.student_updated'));
	}	

	public function getStudentAddressesView($studentId)
	{
		$this->authorize('edit_grade');

		return view('students::view_student_addreses', ['student' => $this->studentRepository->findStudent($studentId)]);
	}		

	public function getStudentAddressesEdit($studentId)
	{
		return view('students::edit_student_addreses', ['student' => $this->studentRepository->findStudent($studentId)]);
	}	

	public function postStudentAccountEdit(UpdateStudentAccountRequest $request, $studentId)
	{
		$this->authorize('edit_user_account_info');

		$this->studentRepository->updateStudent($request->all(), $studentId);

		return $this->printJson(true, [], trans('students::student.student_updated'));
	}

	public function getStudentAccountEdit($studentId)
	{
		$this->authorize('edit_user_account_info');

		return view('students::edit_student_account', [
				'student' => $this->studentRepository->findStudent($studentId),
				'account_form_validator' => $this->jsValidator(UpdateStudentAccountRequest::class)
			]);
	}	

	public function getStudentAccountView($studentId)
	{
		$this->authorize('view_user_account_info');

		return view('students::view_student_account', [
				'student' => $this->studentRepository->findStudent($studentId)
			]);
	}

	public function getStudentDetailView($studentId)
	{
		$student = $this->studentRepository->findStudent($studentId);

		$this->authorize('view_student_general_details', $student);

		return view('students::view_student_details', [
				'student' => $student
			]);
	}

	public function getStudentList(StudentListCriteria $criteria)
	{
		$this->authorize('list_students');

		return view('students::students_list', [
				'criteria' => $criteria,
				'students' => $this->studentRepository->getStudents($criteria)
								->with('classes', 'guardians', 'user')
								->paginate()
			]);
	}

	public function postStudentNew(CreateStudentRequest $request)
	{
		$this->authorize('create_student');

		$student = $this->studentRepository->createStudent($request->all());

		return $this->printRedirect(route('student.details.edit', $student->id));
	}

	public function getStudentNew()
	{
		$this->authorize('create_student');

		return view('students::edit_student_details', [
				'student' => null,
				'student_categories' => $this->studentRepository->getStudentCategories()->paginate(),
				'student_form_validator' => $this->jsValidator(CreateStudentRequest::class)
			]);
	}

	public function __construct(StudentRepository $studentRepository, ClassRepository $classRepository)
	{
		$this->studentRepository = $studentRepository;
		$this->classRepository = $classRepository;
	}
}
