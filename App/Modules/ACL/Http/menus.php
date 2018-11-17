<?php

Menu::group(trans('acl::menu.users'), 'fa-user', function ($parent) {
    Menu::create('users.manage', trans('acl::menu.user_manage'))->setParent($parent)->setPath('users.manage');
})->setOrder(0)->setPosition('right');
