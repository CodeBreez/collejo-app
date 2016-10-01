@if(is_null($student))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">{{ trans('students::student.student_details') }}</a></li>
    <li class="disabled"><a href="#">{{ trans('students::student.account_details') }}</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['student.details.edit'])) }}">
    	<a href="{{ route('student.details.edit', $student->id) }}">{{ trans('students::student.student_details') }}</a>
    </li>
    @can('edit_user_account_info')
        <li class="{{ active_class(if_route(['student.account.edit'])) }}">
        	<a href="{{ route('student.account.edit', $student->id) }}">{{ trans('students::student.account_details') }}</a>
        </li>
    @endcan
</ul>

@endif