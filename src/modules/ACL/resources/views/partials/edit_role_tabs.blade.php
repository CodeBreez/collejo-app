<ul class="nav nav-tabs tabs-left">

	@foreach(Module::all() as $m)

		@if($m->permissions->count())

	    <li class="{{ active_class($m->name == $module->name) }}">
	    	<a href="{{ route('role.permissions.edit', [$role->id, $m->name]) }}">{{ $m->displayName }}</a>
	    </li>

	    @endif

	@endforeach

</ul>
