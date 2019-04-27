<ul class="nav nav-pills flex-md-column">

    @if(is_null($employee_position))

        <li class="nav-item">
            <a href="#" class="nav-link active">{{ trans('employees::employee_position.employee_position_details') }}</a>
        </li>

    @else

        <li class="nav-item">
            <a href="{{ route('employee_position.details.edit', $employee_position->id) }}"
               class="nav-link {{ active_class(if_route(['employee_position.details.edit'])) }}">
                {{ trans('employees::employee_position.employee_position_details') }}
            </a>
        </li>

    @endif

</ul>