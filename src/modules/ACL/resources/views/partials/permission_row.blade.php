<li>
	<div class="checkbox-row">

		@if($userRepository->roleHasPermission($role, $permission))

        	<input type="checkbox" class="chk-permission" value="{{ $permission->permission }}" name="permissions[]" id="{{ $permission->permission }}" checked>
        
        @else

        	<input type="checkbox" class="chk-permission" value="{{ $permission->permission }}" name="permissions[]" id="{{ $permission->permission }}">

        @endif

        <label for="{{ $permission->permission }}"> <span>{{ ucfirst(str_replace('_', ' ', $permission->permission)) }}</span></label> 
    </div>

	@if($permission->children->count())

		<ul class="list-unstyled list-indented">
			
			@foreach($permission->children as $child)

				@include('acl::partials.permission_row', ['permission' => $child])

			@endforeach

		</ul>

	@endif

</li>