<?php 

namespace Collejo\App\Modules\Subjects\Http\Controllers;

use Collejo\App\Http\Controllers\Controller as BaseController;
use Collejo\App\Repository\SubjectRepository;
use Collejo\App\Modules\Subjects\Http\Requests\CreateSubjectRequest;

class SubjectController extends BaseController
{

	protected $subjectRepository;

	public function getSubjectNew()
	{
		$this->authorize('create_subject');

        return view('subjects::edit_subject_details', [
                'subject' => null,
                'subject_form_validator' => $this->jsValidator(CreateSubjectRequest::class)
            ]);
	}

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
