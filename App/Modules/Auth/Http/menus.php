<?php

Menus::group(trans('auth::menu.account'), 'fa-graduation-cap', function($parent){

	Menus::create('logout', trans('auth::menu.logout'))->setParent($parent)->setPath('auth.logout');

})->setOrder(1)->setPosition('right');