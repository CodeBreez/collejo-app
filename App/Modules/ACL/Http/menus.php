<?php

Menu::create('users.manage', trans('acl::menu.user_manage'))->setParent('administration')->setPath('users.manage');
