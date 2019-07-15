<ul class="nav nav-pills flex-md-column">

    @if(is_null($user))

        <li class="nav-item"><a class="nav-link active" href="#">{{ trans('acl::user.user_details') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="#">{{ trans('acl::user.user_roles') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="#">{{ trans('acl::user.account_details') }}</a></li>

    @else

        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['user.details.edit'])) }}"
               href="{{ route('user.details.edit', $user->id) }}">{{ trans('acl::user.user_details') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['user.roles.edit'])) }}"
               href="{{ route('user.roles.edit', $user->id) }}">{{ trans('acl::user.user_roles') }}</a>
        </li>

        @can('edit_user_account_info')
            <li class="nav-item">
                <a class="nav-link {{ active_class(if_route(['user.account.edit'])) }}"
                   href="{{ route('user.account.edit', $user->id) }}">{{ trans('acl::user.account_details') }}</a>
            </li>
        @endcan
    @endif

</ul>

