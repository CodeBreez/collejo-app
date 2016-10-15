@if(is_null($guardian))

<ul class="nav nav-tabs tabs-left">
    <li class="active"><a href="#">{{ trans('students::guardian.guardian_details') }}</a></li>
    <li class="disabled"><a href="#">{{ trans('students::guardian.account_details') }}</a></li>
</ul>

@else

<ul class="nav nav-tabs tabs-left">
    <li class="{{ active_class(if_route(['guardian.details.edit'])) }}">
    	<a href="{{ route('guardian.details.edit', $guardian->id) }}">{{ trans('students::guardian.guardian_details') }}</a>
    </li>
    @can('edit_user_account_info')
        <li class="{{ active_class(if_route(['guardian.account.edit'])) }}">
        	<a href="{{ route('guardian.account.edit', $guardian->id) }}">{{ trans('students::guardian.account_details') }}</a>
        </li>
    @endcan
</ul>

@endif