<tr id="{{ $guardian->id }}">
    <td>
        <div><a href="{{ route('guardian.details.view', $guardian->id) }}">{{ $guardian->name }}</a></div>
        <small class="text-muted">{{ $guardian->ssn }}</small>
    </td>
    <td>
        @if($guardian->students)
            @foreach($guardian->students as $student)
                <a href="#">{{ $student->name }}</a>
            @endforeach
        @endif
    </td>   
    <td class="tools-column">
        <a href="{{ route('guardian.details.edit', $guardian->id) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
    </td>
</tr>