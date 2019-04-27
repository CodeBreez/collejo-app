<ul class="nav nav-pills flex-md-column">

    <li class="nav-item">
    	<a class="nav-link {{ active_class(if_route(['guardian.details.view'])) }}"
           href="{{ route('guardian.details.view', $guardian->id) }}">
            {{ trans('students::guardian.guardian_details') }}
        </a>
    </li>

    @can('view_guardian_student_details')
        <!--li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['guardian.students.view'])) }}"
               href="{{ route('guardian.students.view', $guardian->id) }}">
                {{ trans('students::guardian.students_details') }}
            </a>
        </li-->
    @endcan

    @can('view_user_account_info')
	    <li class="nav-item">
	    	<a class="nav-link {{ active_class(if_route(['guardian.account.view'])) }}"
               href="{{ route('guardian.account.view', $guardian->id) }}">
                {{ trans('students::guardian.account_details') }}
            </a>
	    </li>
    @endcan

</ul>
