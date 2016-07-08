@if(is_null($student))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">Student Details</a></li>
    <li class="disabled"><a href="#">Contact Details</a></li>
    <li class="disabled"><a href="#">Account Details</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['student.details.edit'])) }}">
    	<a href="{{ route('student.details.edit', $student->id) }}">Student Details</a>
    </li>
    <li class="{{ active_class(if_route(['student.addresses.view'])) }}">
    	<a href="{{ route('student.addresses.view', $student->id) }}">Contact Details</a>
    </li>
    <li class="{{ active_class(if_route(['student.account.edit'])) }}">
    	<a href="{{ route('student.account.edit', $student->id) }}">Account Details</a>
    </li>
</ul>

@endif