<tr id="{{ $student->id }}">
    <td>
        <div><a href="{{ route('student.details.view', $student->id) }}">{{ $student->name }}</a></div>
        <small class="text-muted">{{ $student->admission_number }}</small>
    </td>
    <td>{{ formatDate(toUserTz($student->admitted_on)) }}</td>
    <td>
        @if($student->batch)
            {{ $student->batch->name }}
        @endif
    </td>
    <td>
        @if($student->grade)
            {{ $student->grade->name }}
        @endif
    </td>
    <td>
        @if($student->class)
            {{ $student->class->name }}
        @else
            @can('assign_student_to_class')
                <a class="btn btn-xs btn-warning" href="{{ route('student.assign_class', $student->id) }}" data-toggle="ajax-modal">{{ trans('students::student.assign_class') }}</a>
            @endcan
        @endif
    </td>
    <td>
        @if($student->guardians->count())
            @foreach($student->guardians as $guardian)
                <a href="#">{{ $guardian->name }}</a><br>
            @endforeach                
        @else
            @can('assign_guardian_to_student')
                <a class="btn btn-xs btn-warning" href="{{ route('student.assign_guardian', $student->id) }}" data-toggle="ajax-modal">{{ trans('students::student.assign_guardian') }}</a>
            @endcan
        @endif
    </td>    
    <td class="tools-column">
        @can('edit_student_general_details')
            <a href="{{ route('student.details.edit', $student->id) }}" class="btn btn-xs btn-default"><i class="fa fa-fw fa-edit"></i> {{ trans('common.edit') }}</a>
        @endcan
    </td>
</tr>