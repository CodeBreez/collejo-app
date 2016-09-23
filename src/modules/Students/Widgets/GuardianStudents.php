<?php

namespace Collejo\App\Modules\Students\Widgets;

use Collejo\Core\Foundation\Widget\Widget as BaseWidget;

class GuardianStudents extends BaseWidget {

	public $location = 'dash.col1';

	public $permissions = [];

	public $view = 'students::widgets.guardian_students';
}