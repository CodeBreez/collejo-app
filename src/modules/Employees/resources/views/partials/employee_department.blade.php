<tr id="{{ $employee_department->id }}">
    <td>
        <div><a href="#">{{ $employee_department->name }}</a></div>
    </td>
    <td>{{ $employee_department->code }}</td>
    <td class="tools-column">
        <a href="{{ route('employee_department.edit', $employee_department->id) }}" data-toggle="ajax-modal" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('common.edit') }}</a>
    </td>
</tr>