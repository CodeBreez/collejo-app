<tr id="{{ $employee_position->id }}">
    <td>
        <div><a href="#">{{ $employee_position->name }}</a></div>
    </td>
    <td>{{ $employee_position->employeeCategory->name }}</td>
    <td class="tools-column">
        <a href="{{ route('employee_position.edit', $employee_position->id) }}" data-toggle="ajax-modal" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
    </td>
</tr>