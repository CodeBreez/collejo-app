<?php

namespace Collejo\Core\Foundation\Setup\Checkup;

use Collejo\Core\Foundation\Setup\Checkup;
use Collejo\Core\Contracts\Setup\Checkup as CheckupContract;

class CheckEnvFile extends Checkup implements CheckupContract{


	public function run($params = [])
	{
		$this->status = is_writable(base_path('.env'));

		if ($this->status) {
			
			$this->result = trans('collejo::setup.check_env.success');
			$this->help = '';
			
		} else {

			$this->result = trans('collejo::setup.check_env.fail');
			$this->help = trans('collejo::setup.check_env.help');
		}
	
		$this->description = trans('collejo::setup.check_env.info');

		return $this;
	}
}