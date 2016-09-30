<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['batch.details.view'])) }}">
    	<a href="{{ route('batch.details.view', $batch->id) }}">{{ trans('classes::batch.batch_details') }}</a>
    </li>
    <li class="{{ active_class(if_route(['batch.terms.view'])) }}">
    	<a href="{{ route('batch.terms.view', $batch->id) }}">{{ trans('classes::batch.batch_terms') }}</a>
    </li>
    <li class="{{ active_class(if_route(['batch.grades.view'])) }}">
	   <a href="{{ route('batch.grades.view', $batch->id) }}">{{ trans('classes::batch.batch_grades') }}</a>
    </li>
</ul>