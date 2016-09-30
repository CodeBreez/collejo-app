<tr id="{{ $student_category->id }}">
    <td>{{ $student_category->name }}</td>
    <td>{{ $student_category->code }}</td>
    <td>{{ $student_category->students()->count() }}</td>
    <td class="tools-column">
    	@can('add_edit_student_category')
        	<a href="{{ route('student_category.edit', $student_category->id) }}" data-toggle="ajax-modal" class="btn btn-xs 
        	btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
        @endcan
    </td>
</tr>