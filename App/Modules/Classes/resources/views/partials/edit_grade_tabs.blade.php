@if(is_null($grade))

<ul class="nav nav-pills flex-column">
    <li class="nav-item active">
        <a class="nav-link" href="#">{{ trans('classes::grade.grade_details') }}</a>
    </li>
    <li class="nav-item disabled">
        <a class="nav-link" href="#">{{ trans('classes::grade.classes') }}</a>
    </li>
</ul>

@else

<ul class="nav nav-pills flex-column">
    <li class="nav-item {{ active_class(if_route(['grade.details.edit'])) }}">
    	<a class="nav-link" href="{{ route('grade.details.edit', $grade->id) }}">{{ trans('classes::grade.grade_details') }}</a>
    </li>
    <li class="nav-item {{ active_class(if_route(['grade.classes.edit'])) }}">
    	<a class="nav-link" href="{{ route('grade.classes.edit', $grade->id) }}">{{ trans('classes::grade.classes') }}</a>
    </li>
</ul>

@endif
