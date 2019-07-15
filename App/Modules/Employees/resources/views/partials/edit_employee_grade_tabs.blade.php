<ul class="nav nav-pills flex-md-column">

    @if(is_null($employee_grade))

        <li class="nav-item">
            <a href="#" class="nav-link active">{{ trans('employees::employee_grade.employee_grade_details') }}</a>
        </li>

    @else

        <li class="nav-item">
            <a href="{{ route('employee_grade.details.edit', $employee_grade->id) }}"
               class="nav-link {{ active_class(if_route(['employee_grade.details.edit'])) }}">
                {{ trans('employees::employee_grade.employee_grade_details') }}
            </a>
        </li>

    @endif

</ul>