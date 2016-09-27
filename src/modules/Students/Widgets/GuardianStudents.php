<?php

namespace Collejo\App\Modules\Students\Widgets;

use Collejo\App\Foundation\Widget\Widget as BaseWidget;

class GuardianStudents extends BaseWidget {

	public $location = 'dash.col1';

	public $permissions = ['view_student_general_details'];

	public $view = 'students::widgets.guardian_students';
}