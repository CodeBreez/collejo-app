<tr id="{{ $class->id }}" class="class-block">
	<td>{{ $class->name }}</td>
	<td class="tools-column">
		<a href="{{ route('grade.class.edit', [$grade->id, $class->id]) }}" data-toggle="ajax-modal" data-modal-backdrop="static" data-modal-keyboard="false" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i>
		</a>
		<a href="{{ route('grade.class.delete', [$grade->id, $class->id]) }}" data-delete-block="class-block" data-toggle="dynamic-delete" data-confirm="Delete this?" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>
		</a>
	</td>
</tr>