<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['grade.details.view'])) }}">
    	<a href="{{ route('grade.details.view', $grade->id) }}">Grade Details</a>
    </li>
    <li class="{{ active_class(if_route(['grade.classes.view'])) }}">
    	<a href="{{ route('grade.classes.view', $grade->id) }}">Classes</a>
    </li>
</ul>
