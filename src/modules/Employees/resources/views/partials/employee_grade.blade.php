<tr id="{{ $employee_grade->id }}">
    <td>
        <div><a href="#">{{ $employee_grade->name }}</a></div>
    </td>
    <td>{{ $employee_grade->code }}</td>
    <td class="tools-column">
        <a href="{{ route('employee_grade.edit', $employee_grade->id) }}" data-toggle="ajax-modal" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
    </td>
</tr>