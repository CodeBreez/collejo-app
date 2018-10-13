<?php

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Students\Contracts\StudentRepository;
use Request;

class StudentController extends Controller
{
    protected $studentRepository;

    /**
     * Render Grades list.
     *
     * @param Request $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStudentList(Request $request)
    {
        $this->authorize('list_students');

        return view('students::students_list', [
                'students' => $this->studentRepository->getStudents()->with('user')
                    ->paginate(),
            ]);
    }

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
}
