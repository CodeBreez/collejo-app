@if(is_null($student))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">{{ trans('students::student.student_details') }}</a></li>
    <li class="disabled"><a href="#">{{ trans('students::student.classes_details') }}</a></li>
    <li class="disabled"><a href="#">{{ trans('students::student.guardians_details') }}</a></li>
    <li class="disabled"><a href="#">{{ trans('students::student.account_details') }}</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['student.details.edit'])) }}">
    	<a href="{{ route('student.details.edit', $student->id) }}">{{ trans('students::student.student_details') }}</a>
    </li>
    @can('assign_student_to_class')
        <li class="{{ active_class(if_route(['student.classes.edit'])) }}">
            <a href="{{ route('student.classes.edit', $student->id) }}">{{ trans('students::student.classes_details') }}</a>
        </li>
    @endcan    
    @can('assign_guardian_to_student')
        <li class="{{ active_class(if_route(['student.guardians.edit'])) }}">
            <a href="{{ route('student.guardians.edit', $student->id) }}">{{ trans('students::student.guardians_details') }}</a>
        </li>
    @endcan   
     @can('edit_student_contact_details')
        <li class="{{ active_class(if_route(['student.addresses.edit'])) }}">
            <a href="{{ route('student.addresses.edit', $student->id) }}">{{ trans('students::student.contact_details') }}</a>
        </li>
    @endcan
    @can('edit_user_account_info')
        <li class="{{ active_class(if_route(['student.account.edit'])) }}">
        	<a href="{{ route('student.account.edit', $student->id) }}">{{ trans('students::student.account_details') }}</a>
        </li>
    @endcan
</ul>

@endif