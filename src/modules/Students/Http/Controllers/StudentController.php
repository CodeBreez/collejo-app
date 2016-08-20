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

class StudentController extends BaseController
{

	protected $studentRepository;
	protected $classRepository;

	public function postStudentClassAssign(AssignClassRequest $request, $studentId)
	{
		$this->studentRepository->assignToClass($request->get('batch_id'),  $request->get('grade_id'), $request->get('class_id'), $studentId);

		return $this->printPartial(view('students::partials.student', [
				'student' => $this->studentRepository->find($studentId),
			]), trans('students::student.student_updated'));
	}

	public function getStudentClassAssign($studentId)
	{
		return $this->printModal(view('students::modals.assign_class', [
				'student' => $this->studentRepository->find($studentId),
				'batches' => $this->classRepository->activeBatches()->get()
			]));
	}

	public function getStudentAddressDelete($studentId, $addressId)
	{
		$this->studentRepository->deleteAddress($addressId, $studentId);

		return $this->printJson(true, [], trans('students::address.address_deleted'));
	}

	public function postStudentAddressEdit(UpdateAddressRequest $request, $studentId, $addressId)
	{
		$address = $this->studentRepository->updateAddress($request->all(), $addressId, $studentId);

		return $this->printPartial(view('students::partials.address', [
				'student' => $this->studentRepository->find($studentId),
				'address' => $address
			]), trans('students::address.address_updated'));
	}

	public function getStudentAddressEdit($studentId, $addressId)
	{
		return $this->printModal(view('students::modals.edit_address', [
				'address' => $this->studentRepository->findAddress($addressId, $studentId),
				'student' => $this->studentRepository->find($studentId)
			]));
	}

	public function postStudentAddressNew(CreateAddressRequest $request, $studentId)
	{
		$address = $this->studentRepository->createAddress($request->all(), $studentId);

		return $this->printPartial(view('students::partials.address', [
				'student' => $this->studentRepository->find($studentId),
				'address' => $address
			]), trans('students::address.address_created'));
	}

	public function getStudentAddressNew($studentId)
	{
		return $this->printModal(view('students::modals.edit_address', [
				'address' => null,
				'student' => $this->studentRepository->find($studentId)
			]));
	}

	public function getStudentDetailEdit($studentId)
	{
		return view('students::edit_details', [
				'student' => $this->studentRepository->find($studentId),
				'student_categories' => $this->studentRepository->getStudentCategories()->paginate(config('collejo.pagination.perpage')),
				'student_form_validator' => $this->jsValidator(UpdateStudentRequest::class)
			]);
	}	

	public function postStudentDetailEdit(UpdateStudentRequest $request, $studentId)
	{
		$this->studentRepository->update($request->all(), $studentId);

		return $this->printJson(true, [], trans('students::student.student_updated'));
	}	

	public function getStudentAddressesView($studentId)
	{
		return view('students::view_student_addreses', ['student' => $this->studentRepository->find($studentId)]);
	}		

	public function getStudentAddressesEdit($studentId)
	{
		return view('students::edit_student_addreses', ['student' => $this->studentRepository->find($studentId)]);
	}	

	public function postStudentAccountEdit(UpdateStudentAccountRequest $request, $studentId)
	{
		$this->studentRepository->update($request->all(), $studentId);

		return $this->printJson(true, [], trans('students::student.student_updated'));
	}

	public function getStudentAccountEdit($studentId)
	{
		return view('students::edit_account', [
				'student' => $this->studentRepository->find($studentId),
				'account_form_validator' => $this->jsValidator(UpdateStudentAccountRequest::class)
			]);
	}	

	public function getStudentAccountView($studentId)
	{
		return view('students::view_student_account', [
				'student' => $this->studentRepository->find($studentId)
			]);
	}

	public function getStudentDetailView($studentId)
	{
		return view('students::view_student_details', [
				'student' => $this->studentRepository->find($studentId)
			]);
	}

	public function getStudentList()
	{
		return view('students::students_list', [
				'students' => $this->studentRepository->getStudents()->paginate(config('collejo.pagination.perpage'))
			]);
	}

	public function postStudentNew(CreateStudentRequest $request)
	{
		$student = $this->studentRepository->create($request->all());

		return $this->printRedirect(route('student.details.edit', $student->id));
	}

	public function getStudentNew()
	{
		return view('students::edit_details', [
				'student' => null,
				'student_categories' => $this->studentRepository->getStudentCategories()->paginate(config('collejo.pagination.perpage')),
				'student_form_validator' => $this->jsValidator(CreateStudentRequest::class)
			]);
	}

	public function __construct(StudentRepository $studentRepository, ClassRepository $classRepository)
	{
		$this->studentRepository = $studentRepository;
		$this->classRepository = $classRepository;
	}
}
