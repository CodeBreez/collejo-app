<?php 

namespace Collejo\App\Modules\Subjects\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\SubjectRepository;

class SubjectController extends BaseController
{

	protected $subjectRepository;

	public function getSubjectList()
	{
		$this->authorize('list_subjects');

		return view('subjects::subjects_list', [
				'subjects' => $this->subjectRepository->getSubjects()->paginate(config('collejo.pagination.perpage'))
			]);
	}

	public function __construct(SubjectRepository $subjectRepository)
	{
		$this->subjectRepository = $subjectRepository;
	}
}
