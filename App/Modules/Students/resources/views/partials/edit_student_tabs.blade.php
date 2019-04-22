<ul class="nav nav-pills flex-md-column">

    @if(is_null($student))

        <li class="nav-item">
            <a href="#" class="nav-link active">{{ trans('students::student.student_details') }}</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link disabled">{{ trans('students::student.classes_details') }}</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link disabled">{{ trans('students::student.guardians_details') }}</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link disabled">{{ trans('students::student.contact_details') }}</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link disabled">{{ trans('students::student.account_details') }}</a>
        </li>

    @else

        <li class="nav-item">
            <a href="{{ route('student.details.edit', $student->id) }}"
               class="nav-link {{ active_class(if_route(['student.details.edit'])) }}">
                {{ trans('students::student.student_details') }}
            </a>
        </li>

        @can('assign_student_to_class')
            <li class="nav-item">
                <a href="{{ route('student.classes.edit', $student->id) }}"
                   class="nav-link {{ active_class(if_route(['student.classes.edit'])) }}">
                    {{ trans('students::student.classes_details') }}
                </a>
            </li>
        @endcan

        @can('assign_guardian_to_student')
            <!--li class="nav-item">
                <a href="{{ route('student.guardians.edit', $student->id) }}"
                   class="nav-link {{ active_class(if_route(['student.guardians.edit'])) }}">
                    {{ trans('students::student.guardians_details') }}
                </a>
            </li-->
        @endcan

         @can('edit_student_contact_details')
            <!--li class="nav-item">
                <a href="{{ route('student.addresses.edit', $student->id) }}"
                   class="nav-link {{ active_class(if_route(['student.addresses.edit'])) }}">
                    {{ trans('students::student.contact_details') }}
                </a>
            </li-->
        @endcan

        @can('edit_user_account_info')
            <li class="nav-item">
                <a href="{{ route('student.account.edit', $student->id) }}"
                   class="nav-link {{ active_class(if_route(['student.account.edit'])) }}">
                    {{ trans('students::student.account_details') }}
                </a>
            </li>
        @endcan

    @endif

</ul>