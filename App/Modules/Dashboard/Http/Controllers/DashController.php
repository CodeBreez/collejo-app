<?php

namespace Collejo\App\Modules\Dashboard\Http\Controllers;

use Collejo\App\Http\Controller;

class DashController extends Controller
{
    public function getIndex()
    {
        return view('dashboard::dash')->render();
    }
}
