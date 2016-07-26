<tr id="{{ $employee->id }}">
    <td>
        <div><a href="{{ route('employee.details.view', $employee->id) }}">{{ $employee->name }}</a></div>
        <small class="text-muted">{{ $employee->employee_number }}</small>
    </td>
    <td>{{ formatDate(toUserTz($employee->joined_on)) }}</td>
    <td class="tools-column">
        <a href="{{ route('employee.details.edit', $employee->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('common.edit') }}</a>
    </td>
</tr>