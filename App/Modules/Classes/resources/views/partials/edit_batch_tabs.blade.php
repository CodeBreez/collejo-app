<ul class="nav nav-pills flex-md-column">

    @if(is_null($batch))

        <li class="nav-item">
            <a class="nav-link active" href="#">{{ trans('classes::batch.batch_details') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">{{ trans('classes::batch.batch_terms') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">{{ trans('classes::batch.batch_grades') }}</a>
        </li>

    @else

        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['batch.details.edit'])) }}"
               href="{{ route('batch.details.edit', $batch->id) }}">{{ trans('classes::batch.batch_details') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['batch.terms.edit'])) }}"
               href="{{ route('batch.terms.edit', $batch->id) }}">{{ trans('classes::batch.batch_terms') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['batch.grades.edit'])) }}"
               href="{{ route('batch.grades.edit', $batch->id) }}">{{ trans('classes::batch.batch_grades') }}</a>
        </li>

    @endif

</ul>
