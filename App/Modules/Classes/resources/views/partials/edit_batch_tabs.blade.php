@if(is_null($batch))

    <ul class="nav nav-pills flex-column">
        <li class="nav-item"><a class="nav-link active" href="#">Batch Details</a></li>
        <li class="nav-item"><a class="nav-link disabled" href="#">Terms</a></li>
        <li class="nav-item"><a class="nav-link disabled" href="#">Grades</a></li>
</ul>

@else

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['batch.details.edit'])) }}"
               href="{{ route('batch.details.edit', $batch->id) }}">Batch Details</a>
    </li>
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['batch.terms.edit'])) }}"
               href="{{ route('batch.terms.edit', $batch->id) }}">Terms</a>
    </li>
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['batch.grades.edit'])) }}"
               href="{{ route('batch.grades.edit', $batch->id) }}">Grades</a>
    </li>
</ul>

@endif