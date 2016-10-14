<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['student.details.view'])) }}">
    	<a href="{{ route('student.details.view', $student->id) }}">{{ trans('students::student.student_details') }}</a>
    </li>
    @can('view_student_guardian_details')
	    <li class="{{ active_class(if_route(['student.guardians.view'])) }}">
	    	<a href="{{ route('student.guardians.view', $student->id) }}">{{ trans('students::student.guardians_details') }}</a>
	    </li>
    @endcan
    @can('view_user_account_info')
	    <li class="{{ active_class(if_route(['student.account.view'])) }}">
	    	<a href="{{ route('student.account.view', $student->id) }}">{{ trans('students::student.account_details') }}</a>
	    </li>
    @endcan
</ul>
