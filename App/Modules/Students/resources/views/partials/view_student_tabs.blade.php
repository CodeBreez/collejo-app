<ul class="nav nav-pills flex-md-column">

    <li class="nav-item">
    	<a class="nav-link {{ active_class(if_route(['student.details.view'])) }}"
           href="{{ route('student.details.view', $student->id) }}">
            {{ trans('students::student.student_details') }}
        </a>
    </li>

    @can('view_student_class_details')
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['student.classes.view'])) }}"
               href="{{ route('student.classes.view', $student->id) }}">
                {{ trans('students::student.classes_details') }}
            </a>
        </li>
    @endcan

    @can('view_student_guardian_details')
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['student.guardians.view'])) }}"
               href="{{ route('student.guardians.view', $student->id) }}">
                {{ trans('students::student.guardians_details') }}
            </a>
        </li>
    @endcan

    @can('edit_student_contact_details')
	    <li class="nav-item">
	    	<a class="nav-link {{ active_class(if_route(['student.addresses.view'])) }}"
               href="{{ route('student.addresses.view', $student->id) }}">
                {{ trans('students::student.contact_details') }}
            </a>
	    </li>
    @endcan

    @can('view_user_account_info')
	    <li class="nav-item">
	    	<a class="nav-link {{ active_class(if_route(['student.account.view'])) }}"
               href="{{ route('student.account.view', $student->id) }}">
                {{ trans('students::student.account_details') }}
            </a>
	    </li>
    @endcan

</ul>
