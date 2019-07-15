<ul class="nav nav-pills flex-md-column">

    <li class="nav-item">
        <a class="nav-link {{ active_class(if_route(['employee.details.view'])) }}"
           href="{{ route('employee.details.view', $employee->id) }}">
            {{ trans('employees::employee.employee_details') }}
        </a>
    </li>

    @can('view_user_account_info')
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['employee.account.view'])) }}"
               href="{{ route('employee.account.view', $employee->id) }}">
                {{ trans('employees::employee.account_details') }}
            </a>
        </li>
    @endcan

</ul>
