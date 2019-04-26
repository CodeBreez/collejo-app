<ul class="nav nav-pills flex-md-column">
	<li class="nav-item">
		<a class="nav-link {{ active_class(if_route(['user.profile'])) }}"
		   href="{{ route('user.profile', $user->id) }}">
			{{ trans('acl::user.user_details') }}
		</a>
    </li>
</ul>
