<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['student.details.view'])) }}">
    	<a href="{{ route('student.details.view', $student->id) }}">{{ trans('students::student.student_details') }}</a>
    </li>
    <li class="{{ active_class(if_route(['student.addresses.view'])) }}">
    	<a href="{{ route('student.addresses.view', $student->id) }}">{{ trans('students::student.contact_details') }}</a>
    </li>
    <li class="{{ active_class(if_route(['student.account.view'])) }}">
    	<a href="{{ route('student.account.view', $student->id) }}">{{ trans('students::student.account_details') }}</a>
    </li>
</ul>
