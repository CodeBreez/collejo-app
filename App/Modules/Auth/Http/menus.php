<?php

Menu::group(trans('auth::menu.my_account'), 'fa-user-circle-o', function ($parent) {

    Menu::group(function($parent){

        Menu::create('my_profile', trans('auth::menu.my_profile'))->setParent($parent)->setPath('user.profile');
    })->setParent($parent);

    Menu::create('logout', trans('auth::menu.logout'))->setParent($parent)->setPath('auth.logout');

})->setOrder(1)->setPosition('right');
