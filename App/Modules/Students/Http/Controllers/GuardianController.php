<?php

namespace Collejo\App\Modules\Students\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Students\Contracts\GuardianRepository;
use Collejo\App\Modules\Students\Criteria\GuardiansListCriteria;
use Request;

class StudentController extends Controller
{
    protected $guardianRepository;

    /**
     * @param GuardiansListCriteria $criteria
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getGuardiansList(GuardiansListCriteria $criteria)
    {
        $this->authorize('list_guardians');

        return view('students::guardians_list', [
            'criteria' => $criteria,
            'guardians' => $this->guardianRepository->getGuardians($criteria)->with('user', 'students')
                ->paginate(config('collejo.pagination.perpage'))
        ]);
    }

    public function __construct(GuardianRepository $guardianRepository)
    {
        $this->guardianRepository = $guardianRepository;
    }
}
