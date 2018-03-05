<?php

Menu::create('users', trans('acl::users.roles'))
    ->setParent(Menu::getMenuByName(trans('auth::menu.my_account')))
    ->setPath('users.roles');
