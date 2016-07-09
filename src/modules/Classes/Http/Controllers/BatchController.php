<?php 

namespace Collejo\App\Modules\Classes\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\ClassRepository;
use Collejo\App\Modules\Classes\Http\Requests\CreateBatchRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateBatchRequest;
use Collejo\App\Modules\Classes\Http\Requests\CreateTermRequest;
use Collejo\App\Modules\Classes\Http\Requests\UpdateTermRequest;

class BatchController extends BaseController
{

	protected $classRepository;

	public function getBatchTermDelete($batchId, $termId)
	{
		$this->classRepository->deleteTerm($termId, $batchId);

		return $this->printJson(true, [], 'Term Deleted');
	}

	public function postBatchTermEdit(UpdateTermRequest $request, $batchId, $termId)
	{
		$term = $this->classRepository->updateTerm($request->all(), $termId, $batchId);

		return $this->printPartial(view('classes::partials.term', [
				'batch' => $this->classRepository->findBatch($batchId),
				'term' => $term
			]), 'Term updated');
	}

	public function getBatchTermEdit($batchId, $termId)
	{
		return $this->printModal(view('classes::modals.edit_term', [
				'term' => $this->classRepository->findTerm($termId, $batchId), 
				'batch' => $this->classRepository->findBatch($batchId)
			]));
	}

	public function postBatchTermNew(CreateTermRequest $request, $batchId)
	{
		$term = $this->classRepository->createTerm($request->all(), $batchId);

		return $this->printPartial(view('classes::partials.term', [
				'batch' => $this->classRepository->findBatch($batchId),
				'term' => $term
			]), 'Term Created');
	}

	public function getBatchTermNew($batchId)
	{
		return $this->printModal(view('classes::modals.edit_term', [
				'term' => null, 
				'batch' => $this->classRepository->findBatch($batchId)
			]));
	}

	public function getBatchTerms($batchId)
	{
		return view('classes::edit_term', ['batch' => $this->classRepository->findBatch($batchId)]);
	}

	public function getBatchDetailsEdit($batchId)
	{
		return view('classes::edit_batch', ['batch' => $this->classRepository->findBatch($batchId)]);
	}

	public function postBatchDetailsEdit(UpdateBatchRequest $request, $batchId)
	{
		$this->classRepository->updateBatch($request->all(), $batchId);

		return $this->printJson(true, [], 'Batch Updated');
	}

	public function postBatchNew(CreateBatchRequest $request)
	{
		$batch = $this->classRepository->createBatch($request->all());

		return $this->printRedirect(route('batch.details.edit', $batch->id));
	}

	public function getBatchNew()
	{
		return view('classes::edit_batch', ['batch' => null]);
	}

	public function getBatchList()
	{
		return view('classes::batches_list', ['batches' => $this->classRepository->getBatches()]);
	}

	public function __construct(ClassRepository $classRepository)
	{
		$this->classRepository = $classRepository;
	}
}
