@if(is_null($student))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">Student Details</a></li>
    <li class="disabled"><a href="#">Contact Details</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="{{ route('students.edit.details', $student->id) }}">Student Details</a></li>
    <li><a href="{{ route('students.edit.contacts', $student->id) }}">Contact Details</a></li>
</ul>

@endif