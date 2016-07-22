@if(is_null($batch))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">Batch Details</a></li>
    <li class="disabled"><a href="#">Terms</a></li>
    <li class="disabled"><a href="#">Grades</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['batch.details.edit'])) }}">
    	<a href="{{ route('batch.details.edit', $batch->id) }}">Batch Details</a>
    </li>
    <li class="{{ active_class(if_route(['batch.terms.edit'])) }}">
    	<a href="{{ route('batch.terms.edit', $batch->id) }}">Terms</a>
    </li>
    <li class="{{ active_class(if_route(['batch.grades.edit'])) }}">
    	<a href="{{ route('batch.grades.edit', $batch->id) }}">Grades</a>
    </li>
</ul>

@endif