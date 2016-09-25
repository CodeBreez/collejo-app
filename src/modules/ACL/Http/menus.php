<?php

Menu::group(trans('acl::permission.menu_permissions'), 'fa-lock', function($parent){

	Menu::create('roles.list', trans('acl::permission.menu_roles'))->setParent($parent)->setPermission('add_remove_permission_to_role');
	
})->setOrder(5);