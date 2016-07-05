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

	public function getTermDelete($batchId, $termId)
	{
		$this->classRepository->deleteTerm($termId, $batchId);

		return $this->printJson(true, [], 'Term Deleted');
	}

	public function postTermEdit(UpdateTermRequest $request, $batchId, $termId)
	{
		$term = $this->classRepository->updateTerm($request->all(), $termId, $batchId);

		return $this->printPartial(view('classes::partials.term', [
				'batch' => $this->classRepository->findBatch($batchId),
				'term' => $term
			]), 'Term updated');
	}

	public function getTermEdit($batchId, $termId)
	{
		return $this->printModal(view('classes::modals.edit_term', [
				'term' => $this->classRepository->findTerm($termId, $batchId), 
				'batch' => $this->classRepository->findBatch($batchId)
			]));
	}

	public function postTermNew(CreateTermRequest $request, $batchId)
	{
		$term = $this->classRepository->createTerm($request->all(), $batchId);

		return $this->printPartial(view('classes::partials.term', [
				'batch' => $this->classRepository->findBatch($batchId),
				'term' => $term
			]), 'Term Created');
	}

	public function getTermNew($batchId)
	{
		return $this->printModal(view('classes::modals.edit_term', [
				'term' => null, 
				'batch' => $this->classRepository->findBatch($batchId)
			]));
	}

	public function getTerms($batchId)
	{
		return view('classes::edit_term', ['batch' => $this->classRepository->findBatch($batchId)]);
	}

	public function getDetails($batchId)
	{
		return view('classes::edit_batch', ['batch' => $this->classRepository->findBatch($batchId)]);
	}

	public function postDetails(UpdateBatchRequest $request, $batchId)
	{
		$this->classRepository->updateBatch($request->all(), $batchId);

		return $this->printJson(true, [], 'Batch Updated');
	}

	public function postNew(CreateBatchRequest $request)
	{
		$batch = $this->classRepository->createBatch($request->all());

		return $this->printRedirect(route('classes.batch.edit.detail', $batch->id));
	}

	public function getNew()
	{
		return view('classes::edit_batch', ['batch' => null]);
	}

	public function getList()
	{
		return view('classes::batches_list', ['batches' => $this->classRepository->getBatches()]);
	}

	public function __construct(ClassRepository $classRepository)
	{
		$this->classRepository = $classRepository;
	}
}
