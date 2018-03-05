<?php

namespace Collejo\App\Modules\ACL\Http\Controllers;

use Auth;
use Collejo\App\Http\Controller;

class ACLController extends Controller
{
    public function getManage()
    {
        return 'users';
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
