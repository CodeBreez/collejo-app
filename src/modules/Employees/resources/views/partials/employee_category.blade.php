<tr id="{{ $employee_category->id }}">
    <td>
        <div><a href="#">{{ $employee_category->name }}</a></div>
    </td>
    <td>{{ $employee_category->code }}</td>
    <td class="tools-column">
        <a href="{{ route('employee_category.edit', $employee_category->id) }}" data-toggle="ajax-modal" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('common.edit') }}</a>
    </td>
</tr>