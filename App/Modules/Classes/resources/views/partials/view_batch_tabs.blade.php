<ul class="nav nav-pills flex-md-column">
    <li class="nav-item">
        <a class="nav-link {{ active_class(if_route(['batch.details.view'])) }}"
           href="{{ route('batch.details.view', $batch->id) }}">{{ trans('classes::batch.batch_details') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ active_class(if_route(['batch.terms.view'])) }}"
           href="{{ route('batch.terms.view', $batch->id) }}">{{ trans('classes::batch.batch_terms') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ active_class(if_route(['batch.grades.view'])) }}"
           href="{{ route('batch.grades.view', $batch->id) }}">{{ trans('classes::batch.batch_grades') }}</a>
    </li>
</ul>