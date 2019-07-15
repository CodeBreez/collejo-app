<ul class="nav nav-pills flex-md-column">

    @if(is_null($role))

        <li class="nav-item"><a class="nav-link active" href="#">{{ trans('acl::role.role_details') }}</a></li>

    @else

        <li class="nav-item">
            <a class="nav-link {{ active_class(if_route(['role.edit'])) }}"
               href="{{ route('role.edit', $role->id) }}">{{ trans('acl::role.role_details') }}</a>
        </li>

    @endif

</ul>

