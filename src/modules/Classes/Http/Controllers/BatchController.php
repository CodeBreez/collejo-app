<?php 

namespace Collejo\App\Modules\Classes\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\ClassRepository;
use Collejo\App\Modules\Classes\Http\Requests\CreateBatchRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateBatchRequest;
use Collejo\App\Modules\Classes\Http\Requests\CreateTermRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateTermRequest;
use Request;

class BatchController extends BaseController
{

	protected $classRepository;

	public function getBatchTermsView($batchId)
	{
		$this->authorize('view_batch');

		return view('classes::view_batch_terms', ['batch' => $this->classRepository->findBatch($batchId)]);
	}

	public function getBatchTermsEdit($batchId)
	{
		$this->authorize('edit_batch');

		return view('classes::edit_batch_terms', ['batch' => $this->classRepository->findBatch($batchId)]);
	}

	public function postBatchGradesEdit(Request $request, $batchId)
	{
		$this->authorize('edit_batch');

		$this->classRepository->assignGradesToBatch($request::get('grades', []), $batchId);

		return $this->printJson(true, [], trans('classes::batch.batch_updated'));
	}

	public function getBatchGradesView($batchId)
	{
		$this->authorize('view_batch');

		return view('classes::view_batch_grades', ['batch' => $this->classRepository->findBatch($batchId)]);
	}

	public function getBatchGradesEdit($batchId)
	{
		$this->authorize('edit_batch');

		return view('classes::edit_batch_grades', [
						'batch' => $this->classRepository->findBatch($batchId),
						'grades' => $this->classRepository->getGrades()->all()
					]);
	}

	public function getBatchTermDelete($batchId, $termId)
	{
		$this->authorize('edit_batch');

		$this->classRepository->deleteTerm($termId, $batchId);

		return $this->printJson(true, [], trans('classes::term.term_deleted'));
	}

	public function postBatchTermEdit(UpdateTermRequest $request, $batchId, $termId)
	{
		$this->authorize('edit_batch');

		$term = $this->classRepository->updateTerm($request->all(), $termId, $batchId);

		return $this->printPartial(view('classes::partials.term', [
				'batch' => $this->classRepository->findBatch($batchId),
				'term' => $term
			]), trans('classes::term.term_updated'));
	}

	public function getBatchTermEdit($batchId, $termId)
	{
		$this->authorize('edit_batch');

		return $this->printModal(view('classes::modals.edit_term', [
				'term' => $this->classRepository->findTerm($termId, $batchId), 
				'batch' => $this->classRepository->findBatch($batchId)
			]));
	}

	public function postBatchTermNew(CreateTermRequest $request, $batchId)
	{
		$this->authorize('edit_batch');

		$term = $this->classRepository->createTerm($request->all(), $batchId);

		return $this->printPartial(view('classes::partials.term', [
				'batch' => $this->classRepository->findBatch($batchId),
				'term' => $term
			]), trans('classes::term.term_created'));
	}

	public function getBatchTermNew($batchId)
	{
		$this->authorize('edit_batch');

		return $this->printModal(view('classes::modals.edit_term', [
				'term' => null, 
				'batch' => $this->classRepository->findBatch($batchId)
			]));
	}

	public function getBatchTerms($batchId)
	{
		$this->authorize('edit_batch');

		return view('classes::view_batch_terms', ['batch' => $this->classRepository->findBatch($batchId)]);
	}

	public function getBatchDetailsView($batchId)
	{
		$this->authorize('view_batch');

		return view('classes::view_batch_details', ['batch' => $this->classRepository->findBatch($batchId)]);	
	}

	public function getBatchDetailsEdit($batchId)
	{
		$this->authorize('edit_batch');

		return view('classes::edit_batch_details', ['batch' => $this->classRepository->findBatch($batchId)]);
	}

	public function postBatchDetailsEdit(UpdateBatchRequest $request, $batchId)
	{
		$this->authorize('edit_batch');

		$this->classRepository->updateBatch($request->all(), $batchId);

		return $this->printJson(true, [], trans('classes::batch.batch_updated'));
	}

	public function postBatchNew(CreateBatchRequest $request)
	{
		$this->authorize('create_batch');

		$batch = $this->classRepository->createBatch($request->all());

		return $this->printRedirect(route('batch.details.edit', $batch->id));
	}

	public function getBatchNew()
	{
		$this->authorize('create_batch');

		return view('classes::edit_batch_details', ['batch' => null]);
	}

	public function getBatchList()
	{
		$this->authorize('view_batch');

		if (!$this->classRepository->getGrades()->count()) {
			return view('collejo::dash.landings.action_required', [
							'message' => trans('classes::batch.no_grades_defined'),
							'help' => trans('classes::batch.no_grades_defined_help'),
							'action' => trans('classes::grade.create_grade'),
							'route' => route('grade.new')
						]);
		}

		return view('classes::batches_list', [
						'batches' => $this->classRepository->getBatches()->withTrashed()->paginate(config('collejo.pagination.perpage'))
					]);
	}

	public function getBatchGrades(Request $request)
	{
		$this->authorize('view_batch');

		return $this->printJson(true, $this->classRepository->findBatch($request::get('batch_id'))->grades->pluck('name', 'id'));
	}

	public function __construct(ClassRepository $classRepository)
	{
		$this->classRepository = $classRepository;
	}
}
