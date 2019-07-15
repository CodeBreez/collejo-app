<?php

Menu::create('users.manage', trans('acl::menu.user_manage'))
    ->setParent('administration')
    ->setPath('users.manage')
    ->setPermission('create_admin');

Menu::create('permissions.manage', trans('acl::menu.user_roles'))
    ->setParent('administration')
    ->setPath('permissions.manage')
    ->setPermission('add_remove_permission_to_role');
