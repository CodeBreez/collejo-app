@if(is_null($subject))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">{{ trans('subjects::subject.subject_details') }}</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['subject.details.edit'])) }}">
    	<a href="{{ route('subject.details.edit', $subject->id) }}">{{ trans('subjects::subject.subject_details') }}</a>
    </li>
</ul>

@endif