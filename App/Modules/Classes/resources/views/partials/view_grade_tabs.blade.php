<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['grade.details.view'])) }}">
    	<a href="{{ route('grade.details.view', $grade->id) }}">{{ trans('classes::grade.grade_details') }}</a>
    </li>
    @can('view_class_details')
	    <li class="{{ active_class(if_route(['grade.classes.view'])) }}">
	    	<a href="{{ route('grade.classes.view', $grade->id) }}">{{ trans('classes::grade.classes') }}</a>
	    </li>
    @endcan
</ul>
