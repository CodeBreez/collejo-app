@if(is_null($batch))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">Batch Details</a></li>
    <li class="disabled"><a href="#">Terms</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['classes.batch.edit.detail'])) }}">
    	<a href="{{ route('classes.batch.edit.detail', $batch->id) }}">Batch Details</a>
    </li>
    <li class="{{ active_class(if_route(['classes.batch.edit.term'])) }}">
    	<a href="{{ route('classes.batch.edit.term', $batch->id) }}">Terms</a>
    </li>
</ul>

@endif