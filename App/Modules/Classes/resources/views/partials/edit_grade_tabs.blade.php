@if(is_null($grade))

    <ul class="nav nav-pills flex-md-column">
    <li class="nav-item">
        <a class="nav-link active" href="#">{{ trans('classes::grade.grade_details') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="#">{{ trans('classes::grade.classes') }}</a>
    </li>
</ul>

@else

    <ul class="nav nav-pills flex-md-column">
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['grade.details.edit'])) }}"
               href="{{ route('grade.details.edit', $grade->id) }}">{{ trans('classes::grade.grade_details') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['grade.classes.edit'])) }}"
               href="{{ route('grade.classes.edit', $grade->id) }}">{{ trans('classes::grade.classes') }}</a>
        </li>
    </ul>

@endif
