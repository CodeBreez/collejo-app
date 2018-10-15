<?php

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Students\Contracts\StudentRepository;
use Collejo\App\Modules\Students\Criteria\StudentListCriteria;
use Collejo\App\Modules\Students\Http\Requests\CreateStudentRequest;
use Request;

class StudentController extends Controller
{
    protected $studentRepository;

    public function getStudentDetailEdit($studentId)
    {
        $this->authorize('edit_student_general_details');

        return view('students::edit_student_details', [
            'student'                => $this->studentRepository->findStudent($studentId),
            'student_categories'     => $this->studentRepository->getStudentCategories()->paginate(),
            'student_form_validator' => $this->jsValidator(UpdateStudentRequest::class),
        ]);
    }

    public function postStudentDetailEdit(UpdateStudentRequest $request, $studentId)
    {
        $this->authorize('edit_student_general_details');

        $this->studentRepository->updateStudent($request->all(), $studentId);

        return $this->printJson(true, [], trans('students::student.student_updated'));
    }

    public function getStudentDetailView($studentId)
    {
        $student = $this->studentRepository->findStudent($studentId);

        $this->authorize('view_student_general_details', $student);

        return view('students::view_student_details', [
            'student' => $student,
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
            'student_categories'     => $this->studentRepository->getStudentCategories()->paginate(),
            'student_form_validator' => $this->jsValidator(CreateStudentRequest::class),
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
                'students' => $this->studentRepository->getStudents($criteria)->with('user')
                    ->paginate(),
            ]);
    }

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
}
