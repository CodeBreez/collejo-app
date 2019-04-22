<ul class="nav nav-pills flex-md-column">
	<li class="nav-item">
		<a class="nav-link {{ active_class(if_route(['user.details.view'])) }}"
		   href="{{ route('user.details.view', $user->id) }}">
			{{ trans('acl::user.user_details') }}
		</a>
    </li>

	<li class="nav-item">
		<a class="nav-link {{ active_class(if_route(['user.roles.view'])) }}"
		   href="{{ route('user.roles.view', $user->id) }}">
			{{ trans('acl::user.user_roles') }}
		</a>
	</li>

	@can('edit_user_account_info')
		<li class="nav-item">
			<a class="nav-link {{ active_class(if_route(['user.account.view'])) }}"
			   href="{{ route('user.account.view', $user->id) }}">{{ trans('acl::user.account_details') }}</a>
		</li>
	@endcan
</ul>
