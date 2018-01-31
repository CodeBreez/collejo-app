<ul class="nav nav-pills flex-md-column">
	<li class="nav-item">
		<a class="nav-link {{ active_class(if_route(['grade.details.view'])) }}"
		   href="{{ route('grade.details.view', $grade->id) }}">{{ trans('classes::grade.grade_details') }}</a>
    </li>
    @can('view_class_details')
		<li class="nav-item">
			<a class="nav-link {{ active_class(if_route(['grade.classes.view'])) }}"
			   href="{{ route('grade.classes.view', $grade->id) }}">{{ trans('classes::grade.classes') }}</a>
	    </li>
    @endcan
</ul>
