@if(is_null($student))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">Student Details</a></li>
    <li class="disabled"><a href="#">Contact Details</a></li>
    <li class="disabled"><a href="#">Account Details</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['students.edit.details'])) }}">
    	<a href="{{ route('students.edit.details', $student->id) }}">Student Details</a>
    </li>
    <li class="{{ active_class(if_route(['students.edit.addresses'])) }}">
    	<a href="{{ route('students.edit.addresses', $student->id) }}">Contact Details</a>
    </li>
    <li class="{{ active_class(if_route(['students.edit.account'])) }}">
    	<a href="{{ route('students.edit.account', $student->id) }}">Account Details</a>
    </li>
</ul>

@endif