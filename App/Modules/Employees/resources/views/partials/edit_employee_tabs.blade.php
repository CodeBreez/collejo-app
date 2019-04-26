<ul class="nav nav-pills flex-md-column">

    @if(is_null($employee))

        <li class="nav-item">
            <a href="#" class="nav-link active">{{ trans('employees::employee.employee_details') }}</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link disabled">{{ trans('employees::employee.account_details') }}</a>
        </li>

    @else

        <li class="nav-item">
            <a href="{{ route('employee.details.edit', $employee->id) }}"
               class="nav-link {{ active_class(if_route(['employee.details.edit'])) }}">
                {{ trans('employees::employee.employee_details') }}
            </a>
        </li>

        @can('edit_user_account_info')
            <li class="nav-item">
                <a href="{{ route('employee.account.edit', $employee->id) }}"
                   class="nav-link {{ active_class(if_route(['employee.account.edit'])) }}">
                    {{ trans('employees::employee.account_details') }}
                </a>
            </li>
        @endcan

    @endif

</ul>