@if(is_null($grade))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">Grade Details</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['classes.grade.edit.detail'])) }}">
    	<a href="{{ route('classes.grade.edit.detail', $grade->id) }}">Grade Details</a>
    </li>
</ul>

@endif