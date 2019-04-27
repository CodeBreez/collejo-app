<ul class="nav nav-pills flex-md-column">

    @if(is_null($guardian))

        <li class="nav-item">
            <a href="#" class="nav-link active">{{ trans('students::guardian.guardian_details') }}</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link disabled">{{ trans('students::guardian.account_details') }}</a>
        </li>

    @else

        <li class="nav-item">
            <a href="{{ route('guardian.details.edit', $guardian->id) }}"
               class="nav-link {{ active_class(if_route(['guardian.details.edit'])) }}">
                {{ trans('students::guardian.guardian_details') }}
            </a>
        </li>

        @can('edit_user_account_info')
            <li class="nav-item">
                <a href="{{ route('guardian.account.edit', $guardian->id) }}"
                   class="nav-link {{ active_class(if_route(['guardian.account.edit'])) }}">
                    {{ trans('students::guardian.account_details') }}
                </a>
            </li>
        @endcan

    @endif

</ul>