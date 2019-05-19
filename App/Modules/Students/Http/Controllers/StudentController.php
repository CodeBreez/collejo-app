<?php

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\ACL\Http\Requests\UpdateUserAccountRequest;
use Collejo\App\Modules\ACL\Presenters\UserAccountPresenter;
use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Students\Contracts\StudentRepository;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;
use Collejo\App\Modules\Students\Http\Requests\AssignStudentClassRequest;
use Collejo\App\Modules\Students\Http\Requests\CreateStudentRequest;
use Collejo\App\Modules\Students\Http\Requests\UpdateStudentDetailsRequest;
use Collejo\App\Modules\Students\Presenters\StudentClassDetailsPresenter;
use Collejo\App\Modules\Students\Presenters\StudentDetailsPresenter;
use Collejo\App\Modules\Students\Presenters\StudentListPresenter;
use Request;

class StudentController extends Controller
{
    protected $studentRepository;
    protected $classRepository;

    /**
     * Get student class assigner
     *
     * @param $studentId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function getStudentClassesEdit ($studentId)
    {
        $this->authorize('assign_student_to_class');

        $student = $this->studentRepository->findStudent($studentId);

        return view('students::assign_student_class', [
            'student'         => present($student, StudentDetailsPresenter::class),
            'classes' => present($student->classes, StudentClassDetailsPresenter::class),
            'student_class_form_validator' => $this->jsValidator(AssignStudentClassRequest::class),
        ]);
    }

    /** Get Student account edit form
     *
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentAccountEdit($studentId)
    {
        $this->authorize('edit_user_account_info');

        $this->middleware('reauth');

        $student = $this->studentRepository->findStudent($studentId);

        return view('students::edit_student_account', [
            'student'                => $student,
            'user'                   => present($student->user, UserAccountPresenter::class),
            'user_form_validator' => $this->jsValidator(UpdateUserAccountRequest::class),
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

        $student = $this->studentRepository->findStudent($studentId);

        return view('students::view_student_account', [
            'user'    => $student->user,
            'student' => $student,
        ]);
    }

    /**
     * Post account edit form.
     *
     * @param UpdateUserAccountRequest $request
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postStudentAccountEdit(UpdateUserAccountRequest $request, $studentId)
    {
        $this->authorize('edit_user_account_info');

        $this->middleware('reauth');

        $this->studentRepository->updateStudent($request->all(), $studentId);

        return $this->printJson(true, [], trans('students::student.student_updated'));
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

        return view('students::view_student_classes_details', [
            'student'         => present($student, StudentDetailsPresenter::class),
            'classes' => present($student->classes, StudentClassDetailsPresenter::class),
        ]);
    }

    /**
     * Get Student details edit form.
     *
     * @param $studentId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
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

        return $this->printRedirect(route('student.details.edit', $student->id),
            trans('students::student.student_created'));
    }

    /**
     * Create new Student.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentNew()
    {
        $this->authorize('create_student');

        return view('students::edit_student_details', [
            'student'                        => null,
            'student_categories'             => $this->studentRepository->getStudentCategories()->get(),
            'student_details_form_validator' => $this->jsValidator(CreateStudentRequest::class),
        ]);
    }

    /**
     * Render Grades list.
     *
     * @param StudentListCriteria $criteria
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
