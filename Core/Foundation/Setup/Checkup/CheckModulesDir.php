<?php

namespace Collejo\Core\Foundation\Setup\Checkup;

use Collejo\Core\Foundation\Setup\Checkup;
use Collejo\Core\Contracts\Setup\Checkup as CheckupContract;

class CheckModulesDir extends Checkup implements CheckupContract{


	public function run($params = [])
	{
		$this->status = is_writable(base_path('Modules'));

		if ($this->status) {
			
			$this->result = trans('collejo::setup.check_env.success');
			$this->help = '';
			
		} else {

			$this->result = trans('collejo::setup.check_env.success');
			$this->help = trans('collejo::setup.check_env.success');
		}
	
		$this->description = trans('collejo::setup.check_env.success');

		return $this;
	}
}