@if(is_null($batch))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">Batch Details</a></li>
    <li class="disabled"><a href="#">Terms</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['batch.details.edit'])) }}">
    	<a href="{{ route('batch.details.edit', $batch->id) }}">Batch Details</a>
    </li>
    <li class="{{ active_class(if_route(['batch.terms.view'])) }}">
    	<a href="{{ route('batch.terms.view', $batch->id) }}">Terms</a>
    </li>
</ul>

@endif