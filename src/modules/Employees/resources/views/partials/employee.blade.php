<tr id="{{ $employee->id }}">
    <td>
        <div><a href="{{ route('employee.details.view', $employee->id) }}">{{ $employee->name }}</a></div>
        <small class="text-muted">{{ $employee->employee_number }}</small>
    </td>
    <td>{{ $employee->employeeGrade->name }}</td>
    <td>{{ $employee->employeePosition->name }}</td>
    <td>{{ $employee->employeePosition->employeeCategory->name }}</td>
    <td>{{ $employee->employeeDepartment->name }}</td>
    <td>{{ formatDate(toUserTz($employee->joined_on)) }}</td>
    <td class="tools-column">
        <a href="{{ route('employee.details.edit', $employee->id) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
    </td>
</tr>