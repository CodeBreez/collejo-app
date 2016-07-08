@if(is_null($grade))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">Grade Details</a></li>
    <li class="disabled"><a href="#">Classes</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['grade.detail.edit'])) }}">
    	<a href="{{ route('grade.detail.edit', $grade->id) }}">Grade Details</a>
    </li>
    <li class="{{ active_class(if_route(['grade.classes.view'])) }}">
    	<a href="{{ route('grade.classes.view', $grade->id) }}">Classes</a>
    </li>
</ul>

@endif