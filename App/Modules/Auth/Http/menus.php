<?php

Menu::group(trans('auth::menu.account'), 'fa-user-circle-o', function ($parent) {
    Menu::create('logout', trans('auth::menu.logout'))->setParent($parent)->setPath('auth.logout');
})->setOrder(1)->setPosition('right');