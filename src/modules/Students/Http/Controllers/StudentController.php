<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\StudentRepository;
use Collejo\App\Repository\ClassRepository;
use Collejo\App\Repository\GuardianRepository;
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

	protected $guardianRepository;

	public function postStudentClassAssign(AssignClassRequest $request, $studentId)
	{
		$this->authorize('assign_student_to_class');

		$this->studentRepository->assignToClass($request->get('batch_id'),  $request->get('grade_id'), $request->get('class_id'), $request->get('current') == 'true', $studentId);

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

	public function getStudentGuardianRemove($studentId, $guardianId)
	{
		$this->authorize('assign_guardian_to_student');

		$this->studentRepository->removeGuardian($guardianId, $studentId);

		return $this->printJson(true, [], trans('students::student.student_updated'));
	}

	public function postStudentGuardianAssign(AssignGuardianRequest $request, $studentId)
	{
		$this->authorize('assign_guardian_to_student');

		$this->studentRepository->assignGuardian($request->get('guardian_id'), $studentId);

		if ($request->get('target') == 'guardians') {
			return $this->printPartial(view('students::partials.student_guardian', [
				'guardian' => $this->guardianRepository->findGuardian($request->get('guardian_id')),
			]), trans('students::student.student_updated'));
		}

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
		$this->authorize('view_student_contact_details');

		return view('students::view_student_addreses', ['student' => $this->studentRepository->findStudent($studentId)]);
	}		

	public function getStudentAddressesEdit($studentId)
	{
		$this->authorize('edit_student_contact_details');
		
		return view('students::edit_student_addreses', ['student' => $this->studentRepository->findStudent($studentId)]);
	}	

	public function getStudentAddressNew($studentId)
	{
		$this->authorize('edit_student_contact_details');

        return $this->printModal(view('students::modals.edit_student_address', [
                'address' => null,
                'student' => $this->studentRepository->findStudent($studentId)
            ]));
	}

	public function postStudentAddressNew(CreateAddressRequest $request, $studentId)
	{
		$this->authorize('edit_student_contact_details');

        $address = $this->studentRepository->createAddress($request->all(), $studentId);

        return $this->printPartial(view('students::partials.student_address', [
                'student' => $this->studentRepository->findStudent($studentId),
                'address' => $address
            ]), trans('students::address.address_created'));
	}

	public function getStudentAddressEdit($studentId, $addressId)
	{
		$this->authorize('edit_student_contact_details');

        return $this->printModal(view('students::modals.edit_address', [
                'address' => $this->studentRepository->findAddress($addressId, $studentId),
                'student' => $this->studentRepository->findStudent($studentId)
            ]));
	}

	public function postStudentAddressEdit(UpdateAddressRequest $request, $studentId, $addressId)
	{
		$this->authorize('edit_student_contact_details');

        $address = $this->studentRepository->updateAddress($request->all(), $addressId, $studentId);

        return $this->printPartial(view('students::partials.student_address', [
                'student' => $this->studentRepository->findStudent($studentId),
                'address' => $address
            ]), trans('students::address.address_updated'));
	}

	public function getStudentAddressDelete($studentId, $addressId)
	{
		$this->authorize('edit_student_contact_details');

        $this->studentRepository->deleteAddress($addressId, $studentId);

        return $this->printJson(true, [], trans('students::address.address_deleted'));
	}

	public function postStudentAccountEdit(UpdateStudentAccountRequest $request, $studentId)
	{
		$this->authorize('edit_user_account_info');

		$this->middleware('reauth');

		$this->studentRepository->updateStudent($request->all(), $studentId);

		return $this->printJson(true, [], trans('students::student.student_updated'));
	}

	public function getStudentAccountEdit($studentId)
	{
		$this->authorize('edit_user_account_info');

		$this->middleware('reauth');

		return view('students::edit_student_account', [
				'student' => $this->studentRepository->findStudent($studentId),
				'account_form_validator' => $this->jsValidator(UpdateStudentAccountRequest::class)
			]);
	}	

	public function getStudentAccountView($studentId)
	{
		$this->authorize('view_user_account_info');

		$this->middleware('reauth');

		return view('students::view_student_account', [
				'student' => $this->studentRepository->findStudent($studentId)
			]);
	}

	public function getStudentGuardiansEdit($studentId)
	{
		$student = $this->studentRepository->findStudent($studentId);

		$this->authorize('view_student_guardian_details', $student);

		return view('students::edit_student_guardians', [
				'student' => $student
			]);
	}

	public function getStudentGuardiansView($studentId)
	{
		$student = $this->studentRepository->findStudent($studentId);

		$this->authorize('view_student_guardian_details', $student);

		return view('students::view_student_guardians_details', [
				'student' => $student
			]);
	}

	public function getStudentClassChange($studentId)
	{
		$student = $this->studentRepository->findStudent($studentId);

		$this->authorize('assign_student_to_class', $student);


	}

	public function postStudentClassChange($studentId)
	{
		$student = $this->studentRepository->findStudent($studentId);

		$this->authorize('assign_student_to_class', $student);


	}
	
	public function getStudentClassesEdit($studentId)
	{
		$student = $this->studentRepository->findStudent($studentId);

		$this->authorize('assign_student_to_class', $student);

		return view('students::edit_classes_details', [
				'student' => $student
			]);
	}	

	public function getStudentClassesView($studentId)
	{
		$student = $this->studentRepository->findStudent($studentId);

		$this->authorize('view_student_class_details', $student);

		return view('students::view_classes_details', [
				'student' => $student,
				'classRepository' => $this->classRepository
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
								->with('guardians', 'user')
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

	public function __construct(StudentRepository $studentRepository, ClassRepository $classRepository, GuardianRepository $guardianRepository)
	{
		$this->studentRepository = $studentRepository;
		$this->classRepository = $classRepository;
		$this->guardianRepository = $guardianRepository;
	}
}
