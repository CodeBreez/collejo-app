<ul class="nav nav-pills flex-md-column">
	<li class="nav-item">
		<a class="nav-link {{ active_class(if_route(['grade.class.details.view'])) }}"
		   href="{{ route('grade.class.details.view', ['id' => $grade->id, 'cid' => $class->id]) }}">
			{{ trans('classes::class.class_details') }}
		</a>
    </li>
</ul>
