<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['guardian.details.view'])) }}">
    	<a href="{{ route('guardian.details.view', $guardian->id) }}">{{ trans('students::guardian.guardian_details') }}</a>
    </li>
    @can('view_user_account_info')
	    <li class="{{ active_class(if_route(['guardian.account.view'])) }}">
	    	<a href="{{ route('guardian.account.view', $guardian->id) }}">{{ trans('students::guardian.account_details') }}</a>
	    </li>
    @endcan
</ul>
