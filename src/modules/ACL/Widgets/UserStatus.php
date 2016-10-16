<?php

namespace Collejo\App\Modules\ACL\Widgets;

use Collejo\App\Foundation\Widget\Widget as BaseWidget;

class UserStatus extends BaseWidget {

	public $location = 'dash.col2';

	public $permissions = ['view_user_account_info'];

	public $view = 'acl::widgets.user_status';
}