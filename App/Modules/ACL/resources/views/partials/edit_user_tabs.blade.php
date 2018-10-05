<ul class="nav nav-pills flex-md-column">

    @if(is_null($user))

        <li class="nav-item"><a class="nav-link active" href="#">{{ trans('acl::user.user_details') }}</a></li>
        <li class="nav-item"><a class="nav-link" href="#">{{ trans('acl::user.user_roles') }}</a></li>

    @else

        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['user.details.edit'])) }}"
               href="{{ route('user.details.view', $user->id) }}">{{ trans('acl::user.user_details') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['user.roles.edit'])) }}"
               href="{{ route('user.roles.view', $user->id) }}">{{ trans('acl::user.user_roles') }}</a>
        </li>

    @endif

</ul>

