<?php 

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\StudentRepository;
use Collejo\App\Modules\Students\Http\Requests\CreateStudentRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentRequest;
use Collejo\App\Modules\Students\Http\Requests\CreateAddressRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateAddressRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentAccountRequest;

class StudentController extends BaseController
{

	protected $studentRepository;

	public function getStudentAddressDelete($studentId, $addressId)
	{
		$this->studentRepository->deleteAddress($addressId, $studentId);

		return $this->printJson(true, [], 'Contact Deleted');
	}

	public function postStudentAddressEdit(UpdateAddressRequest $request, $studentId, $addressId)
	{
		$address = $this->studentRepository->updateAddress($request->all(), $addressId, $studentId);

		return $this->printPartial(view('students::partials.address', [
				'student' => $this->studentRepository->find($studentId),
				'address' => $address
			]), 'Contact updated');
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
			]), 'Contact Created');
	}

	public function getStudentAddressNew($studentId)
	{
		return $this->printModal(view('students::modals.edit_address', [
				'address' => null,
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

	public function getStudentAddresses($studentId)
	{
		return view('students::edit_addresses', ['student' => $this->studentRepository->find($studentId)]);
	}		

	public function postStudentAccount(UpdateStudentAccountRequest $request, $studentId)
	{
		$this->studentRepository->update($request->all(), $studentId);

		return $this->printJson(true, [], 'Student Updated');
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
