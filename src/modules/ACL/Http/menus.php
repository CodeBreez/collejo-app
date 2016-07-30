<?php

Menu::group(trans('acl::permission.menu_permissions'), 'fa-lock', function($parent){

	Menu::create('roles.list', trans('acl::permission.menu_roles'))->setParent($parent)->setPermission('manage_permissions');
	
})->setOrder(5);