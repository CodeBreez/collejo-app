@if(is_null($grade))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">{{ trans('classes::grade.grade_details') }}</a></li>
    <li class="disabled"><a href="#">{{ trans('classes::grade.classes') }}</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['grade.details.edit'])) }}">
    	<a href="{{ route('grade.details.edit', $grade->id) }}">{{ trans('classes::grade.grade_details') }}</a>
    </li>
    <li class="{{ active_class(if_route(['grade.classes.edit'])) }}">
    	<a href="{{ route('grade.classes.edit', $grade->id) }}">{{ trans('classes::grade.classes') }}</a>
    </li>
</ul>

@endif