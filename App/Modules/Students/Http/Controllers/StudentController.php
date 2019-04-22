<?php

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Students\Contracts\StudentRepository;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;
use Collejo\App\Modules\Students\Http\Requests\CreateStudentRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentAccountRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentDetailsRequest;
use Collejo\App\Modules\Students\Presenters\StudentDetailsPresenter;
use Collejo\App\Modules\Students\Presenters\StudentListPresenter;
use Request;

class StudentController extends Controller
{
    protected $studentRepository;
    protected $classRepository;

    /** Get Student account edit form
     *
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentAccountEdit($studentId)
    {
        $this->authorize('edit_user_account_info');

        $this->middleware('reauth');

        return view('students::edit_student_account', [
            'student'                => $this->studentRepository->findStudent($studentId),
            'account_form_validator' => $this->jsValidator(UpdateStudentAccountRequest::class),
        ]);
    }

    /**
     * Get Student account view.
     *
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentAccountView($studentId)
    {
        $this->authorize('view_user_account_info');

        $this->middleware('reauth');

        return view('students::view_student_account', [
            'student' => $this->studentRepository->findStudent($studentId),
        ]);
    }

    /**
     * Get Student Addresses view.
     *
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentAddressesView($studentId)
    {
        $this->authorize('view_student_contact_details');

        return view('students::view_student_addreses', [
            'student' => $this->studentRepository->findStudent($studentId),
        ]);
    }

    /**
     * Get Student Guardians view.
     *
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentGuardiansView($studentId)
    {
        $student = $this->studentRepository->findStudent($studentId);

        $this->authorize('view_student_guardian_details', $student);

        return view('students::view_student_guardians_details', [
            'student' => $student,
        ]);
    }

    public function getStudentClassAssign($studentId)
    {
        $this->authorize('assign_student_to_class');

        return [
            'student' => $this->studentRepository->findStudent($studentId),
            'batches' => $this->classRepository->activeBatches()->get(),
        ];
    }

    /**
     * Get the student classes edit form
     *
     * @param $studentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getStudentClassesEdit($studentId)
    {
        $student = $this->studentRepository->findStudent($studentId);

        $this->authorize('assign_student_to_class', $student);

        return view('students::edit_classes_details', [
            'student' => $student
        ]);
    }

    /**
     * Get Student Classes view.
     *
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentClassesView($studentId)
    {
        $student = $this->studentRepository->findStudent($studentId);

        $this->authorize('view_student_class_details', $student);

        return view('students::view_classes_details', [
            'student'         => $student,
            'classRepository' => $this->classRepository,
        ]);
    }

    /**
     * Get Student details edit form.
     *
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentDetailEdit($studentId)
    {
        $this->authorize('edit_student_general_details');

        return view('students::edit_student_details', [
            'student'                        => present($this->studentRepository->findStudent($studentId), StudentDetailsPresenter::class),
            'student_categories'             => $this->studentRepository->getStudentCategories()->get(),
            'student_details_form_validator' => $this->jsValidator(UpdateStudentDetailsRequest::class),
        ]);
    }

    /**
     * Save Student details.
     *
     * @param UpdateStudentDetailsRequest $request
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postStudentDetailEdit(UpdateStudentDetailsRequest $request, $studentId)
    {
        $this->authorize('edit_student_general_details');

        $this->studentRepository->updateStudent($request->all(), $studentId);

        return $this->printJson(true, [], trans('students::student.student_updated'));
    }

    /**
     * Get Student details view template.
     *
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentDetailView($studentId)
    {
        $student = $this->studentRepository->findStudent($studentId);

        $this->authorize('view_student_general_details', $student);

        return view('students::view_student_details', [
            'student' => present($student, StudentDetailsPresenter::class),
        ]);
    }

    /**
     * Save new Student data.
     *
     * @param CreateStudentRequest $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postStudentNew(CreateStudentRequest $request)
    {
        $this->authorize('create_student');

        $student = $this->studentRepository->createStudent($request->all());

        return $this->printRedirect(route('student.details.edit', $student->id));
    }

    /**
     * Create new Student.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentNew()
    {
        $this->authorize('create_student');

        return view('students::edit_student_details', [
            'student'                => null,
            'student_categories'     => $this->studentRepository->getStudentCategories()->get(),
            'student_details_form_validator' => $this->jsValidator(CreateStudentRequest::class),
        ]);
    }

    /**
     * Render Grades list.
     *
     * @param Request $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentList(StudentListCriteria $criteria)
    {
        $this->authorize('list_students');

        return view('students::students_list', [
                'criteria' => $criteria,
                'students' => present($this->studentRepository->getStudents($criteria)->paginate(), StudentListPresenter::class),
            ]);
    }

    public function __construct(StudentRepository $studentRepository, ClassRepository $classRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->classRepository = $classRepository;
    }
}
