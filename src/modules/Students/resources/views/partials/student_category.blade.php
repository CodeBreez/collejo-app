<tr id="{{ $student_category->id }}">
    <td>{{ $student_category->name }}</td>
    <td>{{ $student_category->code }}</td>
    <td class="tools-column">
        <a href="{{ route('student.details.edit', $student_category->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> {{ trans('common.edit') }}</a>
    </td>
</tr>