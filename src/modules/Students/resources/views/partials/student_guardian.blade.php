<tr id="{{ $guardian->id }}">
    <td>
        <div><a href="{{ route('guardian.details.view', $guardian->id) }}">{{ $guardian->name }}</a></div>
        <small class="text-muted">{{ $guardian->ssn }}</small>
    </td>
    <td>
        @if($guardian->students->count())
            @foreach($guardian->students as $student)
                <a href="{{ route('student.details.view', $student->id) }}">{{ $student->name }}</a>
            @endforeach
        @endif
    </td>   
    <td class="tools-column">
        <a href="{{ route('student.remove_guardian', [$student->id, $guardian->id]) }}" data-success-callback="afterRemoveGuardian" data-confirm="{{ trans('students::student.guardian_remove_confirm') }}" data-toggle="ajax-link" class="btn btn-xs btn-danger"><i class="fa fa-fw fa-edit"></i> {{ trans('common.remove') }}</a>
        <a href="{{ route('guardian.details.edit', $guardian->id) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
    </td>
</tr>