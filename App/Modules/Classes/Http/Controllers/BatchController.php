<?php

namespace Collejo\App\Modules\Classes\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Classes\Contracts\ClassRepository;
use Collejo\App\Modules\Classes\Http\Requests\CreateBatchRequest;
use Collejo\App\Modules\Classes\Http\Requests\CreateTermRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateBatchRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateTermRequest;
use Request;

class BatchController extends Controller
{
    protected $classRepository;

    public function getBatchTermsView($batchId)
    {
        $this->authorize('view_batch_details');

        return view('classes::view_batch_terms', [
                        'batch' => $this->classRepository->findBatch($batchId),
                    ]);
    }

    public function getBatchTermsEdit($batchId)
    {
        $this->authorize('add_edit_batch');

        return view('classes::edit_batch_terms', [
                        'batch' => $this->classRepository->findBatch($batchId),
                    ]);
    }

    public function postBatchGradesEdit(Request $request, $batchId)
    {
        $this->authorize('add_edit_batch');

        $this->classRepository->assignGradesToBatch($request::get('grades', []), $batchId);

        return $this->printJson(true, [], trans('classes::batch.batch_updated'));
    }

    public function getBatchGradesView($batchId)
    {
        $this->authorize('view_batch_details');

        return view('classes::view_batch_grades', [
                        'batch' => $this->classRepository->findBatch($batchId),
                    ]);
    }

    public function getBatchGradesEdit($batchId)
    {
        $this->authorize('add_edit_batch');

        return view('classes::edit_batch_grades', [
                        'batch'  => $this->classRepository->findBatch($batchId),
                        'grades' => $this->classRepository->getGrades()->get(),
                    ]);
    }

    public function getBatchTermDelete($batchId, $termId)
    {
        $this->authorize('add_edit_batch');

        $this->classRepository->deleteTerm($termId, $batchId);

        return $this->printJson(true, [], trans('classes::term.term_deleted'));
    }

    public function postBatchTermEdit(UpdateTermRequest $request, $batchId, $termId)
    {
        $this->authorize('add_edit_batch');

        $attributes = $request->all();

        $attributes['start_date'] = toUTC($attributes['start_date']);
        $attributes['end_date'] = toUTC($attributes['end_date']);

        $term = $this->classRepository->updateTerm($attributes, $termId, $batchId);

        return $this->printJson(true, [
            'term' => $term,
        ], trans('classes::term.term_updated'));
    }

    public function getBatchTermEdit($batchId, $termId)
    {
        $this->authorize('add_edit_batch');

        return $this->printModal(view('classes::modals.edit_term', [
                        'term'  => $this->classRepository->findTerm($termId, $batchId),
                        'batch' => $this->classRepository->findBatch($batchId),
                    ]));
    }

    public function postBatchTermNew(CreateTermRequest $request, $batchId)
    {
        $this->authorize('add_edit_batch');

        $term = $this->classRepository->createTerm($request->all(), $batchId);

        return $this->printJson(true, [
            'term' => $term,
        ], trans('classes::term.term_created'));
    }

    public function getBatchTermNew($batchId)
    {
        $this->authorize('add_edit_batch');

        return $this->printModal(view('classes::modals.edit_term', [
                        'term'  => null,
                        'batch' => $this->classRepository->findBatch($batchId),
                    ]));
    }

    public function getBatchTerms($batchId)
    {
        $this->authorize('view_batch_details');

        return view('classes::view_batch_terms', [
                        'batch' => $this->classRepository->findBatch($batchId),
                    ]);
    }

    public function getBatchDetailsView($batchId)
    {
        $this->authorize('view_batch_details');

        return view('classes::view_batch_details', [
                        'batch' => $this->classRepository->findBatch($batchId),
                    ]);
    }

    public function getBatchDetailsEdit($batchId)
    {
        $this->authorize('add_edit_batch');

        return view('classes::edit_batch_details', [
            'batch'                => $this->classRepository->findBatch($batchId),
            'batch_form_validator' => $this->jsValidator(UpdateBatchRequest::class),
                    ]);
    }

    public function postBatchDetailsEdit(UpdateBatchRequest $request, $batchId)
    {
        $this->authorize('add_edit_batch');

        $this->classRepository->updateBatch($request->all(), $batchId);

        return $this->printJson(true, [], trans('classes::batch.batch_updated'));
    }

    /**
     * Create a new Batch.
     *
     * @param CreateBatchRequest $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postBatchNew(CreateBatchRequest $request)
    {
        $this->authorize('add_edit_batch');

        $batch = $this->classRepository->createBatch($request->all());

        return $this->printRedirect(route('batch.details.edit', $batch->id));
    }

    /**
     * Get form for new Batch.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBatchNew()
    {
        $this->authorize('add_edit_batch');

        return view('classes::edit_batch_details', [
            'batch'                => null,
            'batch_form_validator' => $this->jsValidator(UpdateBatchRequest::class),
        ]);
    }

    /**
     * Render a list of batches.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBatchList()
    {
        $this->authorize('list_batches');

        if (!$this->classRepository->getGrades()->count()) {
            return view('dashboard::landings.action_required', [
                            'message' => trans('classes::batch.no_grades_defined'),
                            'help'    => trans('classes::batch.no_grades_defined_help'),
                            'action'  => trans('classes::grade.create_grade'),
                            'route'   => route('grade.new'),
                        ]);
        }

        return view('classes::batches_list', [
                        'batches' => $this->classRepository->getBatches()->withTrashed()->paginate(config('collejo.perpage')),
                    ]);
    }

    /**
     * View Grades for a Batch.
     *
     * @param Request $request
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBatchGrades(Request $request)
    {
        $this->authorize('view_batch_details');

        return $this->printJson(true, $this->classRepository->findBatch($request::get('batch_id'))->grades->pluck('name', 'id'));
    }

    public function __construct(ClassRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }
}
