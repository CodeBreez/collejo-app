<ul class="nav nav-pills flex-md-column">

    @if(is_null($employee_department))

        <li class="nav-item">
            <a href="#" class="nav-link active">{{ trans('employees::employee_department.employee_department_details') }}</a>
        </li>

    @else

        <li class="nav-item">
            <a href="{{ route('employee_department.details.edit', $employee_department->id) }}"
               class="nav-link {{ active_class(if_route(['employee_department.details.edit'])) }}">
                {{ trans('employees::employee_department.employee_department_details') }}
            </a>
        </li>

    @endif

</ul>