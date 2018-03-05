<?php

namespace Collejo\App\Modules\ACL\Http\Controllers;

use Auth;
use Collejo\App\Http\Controller;

class ACLController extends Controller
{
    public function getRoles()
    {
        return 'acl';
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
