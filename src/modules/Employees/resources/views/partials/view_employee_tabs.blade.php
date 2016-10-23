<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['employee.details.view'])) }}">
    	<a href="{{ route('employee.details.view', $employee->id) }}">{{ trans('employees::employee.employee_details') }}</a>
    </li>
    <li class="{{ active_class(if_route(['employee.addresses.view'])) }}">
    	<a href="{{ route('employee.addresses.view', $employee->id) }}">{{ trans('employees::employee.employee_contacts') }}</a>
    </li>
    <li class="{{ active_class(if_route(['employee.account.view'])) }}">
    	<a href="{{ route('employee.account.view', $employee->id) }}">{{ trans('employees::employee.employee_account') }}</a>
    </li>
</ul>
