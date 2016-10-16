<?php

$studentCriteria = app()->make(Collejo\App\Modules\Students\Criteria\StudentListCriteria::class);
$studentRepository = app()->make(Collejo\App\Contracts\Repository\StudentRepository::class);

$employeeCriteria = app()->make(Collejo\App\Modules\Employees\Criteria\EmployeeListCriteria::class);
$employeeRepository = app()->make(Collejo\App\Contracts\Repository\EmployeeRepository::class);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{ trans('acl::admin.widget_user_status') }}</h3>
    </div>
    <div class="panel-body">

        <dl class="list-group">
        	<li class="list-group-item">
        		{{ trans('acl::admin.widget_students') }}
        		<span class="badge">{{ $studentRepository->getStudents($studentCriteria)->count() }}</span>
        	</li>
        	<li class="list-group-item">
        		{{ trans('acl::admin.widget_employees') }}
        		<span class="badge">{{ $employeeRepository->getEmployees($employeeCriteria)->count() }}</span>
        	</li>
        </dl>

    </div>
</div>