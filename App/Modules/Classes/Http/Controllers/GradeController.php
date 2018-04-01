<?php

namespace Collejo\App\Modules\Classes\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Classes\Http\Requests\CreateClassRequest;
use Collejo\App\Modules\Classes\Http\Requests\CreateGradeRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateClassRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateGradeRequest;
use Request;

class GradeController extends Controller
{
    protected $classRepository;

    /**
     * Delete Grade Class.
     *
     * @param $gradeId
     * @param $classId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGradeClassDelete($gradeId, $classId)
    {
        $this->authorize('add_edit_class');

        $this->classRepository->deleteClass($classId, $gradeId);

        return $this->printJson(true, [], trans('classes::class.class_deleted'));
    }

    /**
     * Save Grade Class.
     *
     * @param UpdateClassRequest $request
     * @param $gradeId
     * @param $classId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postGradeClassEdit(UpdateClassRequest $request, $gradeId, $classId)
    {
        $this->authorize('add_edit_class');

        $class = $this->classRepository->updateClass($request->all(), $classId, $gradeId);

        return $this->printJson(true, [
            'grade' => $this->classRepository->findGrade($gradeId),
            'class' => $class,
        ], trans('classes::class.class_updated'));
    }

    /**
     * Create Grade Class.
     *
     * @param CreateClassRequest $request
     * @param $gradeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postGradeClassNew(CreateClassRequest $request, $gradeId)
    {
        $this->authorize('add_edit_class');

        $class = $this->classRepository->createClass($request->all(), $gradeId);

        return $this->printJson(true, [
            'grade' => $this->classRepository->findGrade($gradeId),
            'class' => $class,
        ], trans('classes::class.class_created'));
    }

    /**
     * Get Grade Details view.
     *
     * @param $gradeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGradeDetailsView($gradeId)
    {
        $this->authorize('view_grade_details');

        return view('classes::view_grade_details', [
            'grade' => $this->classRepository->findGrade($gradeId),
        ]);
    }

    /**
     * View Grade Classes.
     *
     * @param $gradeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGradeClassesView($gradeId)
    {
        $this->authorize('list_classes');

        return view('classes::view_grade_classes', [
            'grade' => $this->classRepository->findGrade($gradeId),
        ]);
    }

    /**
     * Grade Classes Edit view.
     *
     * @param $gradeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGradeClassesEdit($gradeId)
    {
        $this->authorize('add_edit_class');

        return view('classes::edit_grade_classes', [
            'grade' => $this->classRepository->findGrade($gradeId),
        ]);
    }

    /**
     * Grade Class view.
     *
     * @param $gradeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGradeClassView($gradeId, $classId)
    {
        $this->authorize('view_class_details');

        return view('classes::view_class_details', [
            'class' => $this->classRepository->findClass($classId, $gradeId),
            'grade' => $this->classRepository->findGrade($gradeId),
        ]);
    }

    /**
     * Saves the Grade details.
     *
     * @param UpdateGradeRequest $request
     * @param $gradeId
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postGradeDetailsEdit(UpdateGradeRequest $request, $gradeId)
    {
        $this->authorize('add_edit_grade');

        $this->classRepository->updateGrade($request->all(), $gradeId);

        return $this->printJson(true, [], trans('classes::grade.grade_updated'));
    }

    /**
     * Returns the edit details for Grade.
     *
     * @param $gradeId
     *
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGradeDetailsEdit($gradeId)
    {
        $this->authorize('add_edit_grade');

        return view('classes::edit_grade_details', [
                'grade'                => $this->classRepository->findGrade($gradeId),
                'grade_form_validator' => $this->jsValidator(UpdateGradeRequest::class),
            ]);
    }

    /**
     * Saves a new Grade.
     *
     * @param CreateGradeRequest $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postGradeNew(CreateGradeRequest $request)
    {
        $this->authorize('add_edit_grade');

        $grade = $this->classRepository->createGrade($request->all());

        return $this->printRedirect(route('grade.classes.edit', $grade->id));
    }

    /**
     * Render new Grade form.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGradeNew()
    {
        $this->authorize('add_edit_grade');

        return view('classes::edit_grade_details', [
                'grade'                => null,
                'grade_form_validator' => $this->jsValidator(CreateGradeRequest::class),
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
    public function getGradeList(Request $request)
    {
        $this->authorize('list_grades');

        return view('classes::grades_list', [
                'grades' => $this->classRepository->getGrades()->with('classes')
                    ->paginate(config('collejo.pagination.perpage')),
            ]);
    }

    /**
     * Returns the Classes for the Grade.
     *
     * @param Request $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGradeClasses(Request $request)
    {
        $this->authorize('list_classes');

        return $this->printJson(true, $this->classRepository
            ->findGrade($request::get('grade_id'))->classes->pluck('name', 'id'));
    }

    public function __construct(ClassRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }
}
