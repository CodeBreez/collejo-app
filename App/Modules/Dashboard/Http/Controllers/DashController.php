<?php

namespace Collejo\App\Modules\Dashboard\Http\Controllers;

use Collejo\App\Http\Controller;

class DashController extends Controller
{
    /**
     * Show the dashboard view
     *
     * @return string
     * @throws \Throwable
     */
    public function getIndex()
    {
        return view('dashboard::dash')->render();
    }
}
