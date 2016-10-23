@if(is_null($employee))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">{{ trans('employees::employee.employee_details') }}</a></li>
    <li class="disabled"><a href="#">{{ trans('employees::employee.employee_contacts') }}</a></li>
    <li class="disabled"><a href="#">{{ trans('employees::employee.employee_account') }}</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['employee.details.edit'])) }}">
    	<a href="{{ route('employee.details.edit', $employee->id) }}">{{ trans('employees::employee.employee_details') }}</a>
    </li>
    <li class="{{ active_class(if_route(['employee.addresses.edit'])) }}">
    	<a href="{{ route('employee.addresses.edit', $employee->id) }}">{{ trans('employees::employee.employee_contacts') }}</a>
    </li>
    <li class="{{ active_class(if_route(['employee.account.edit'])) }}">
    	<a href="{{ route('employee.account.edit', $employee->id) }}">{{ trans('employees::employee.employee_account') }}</a>
    </li>
</ul>

@endif