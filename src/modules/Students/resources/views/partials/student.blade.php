<tr id="{{ $student->id }}">
    <td>
        <div>{{ $student->name }}</div>
        <small class="text-muted">{{ $student->admission_number }}</small>
    </td>
    <td>
        @if($student->class)
            {{ $student->class->name }}
        @else
            <a class="btn btn-xs btn-warning" href="{{ route('student.assign_class', $student->id) }}" data-toggle="ajax-modal">Assign Class</a>
        @endif
    </td>
    <td class="tools-column">
        <a href="{{ route('student.details.edit', $student->id) }}" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Edit</a>
    </td>
</tr>