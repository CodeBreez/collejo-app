<?php

namespace Collejo\Core\Foundation\Setup\Checkup;

use Collejo\Core\Foundation\Setup\Checkup;
use Collejo\Core\Contracts\Setup\Checkup as CheckupContract;
use Collejo\Core\Database\TestConnector;
use PDOException;

class CheckDB extends Checkup implements CheckupContract{


	public function run($params = [])
	{
		$default = [
			'db_host' => null,
			'db_port' => null,
			'db_database' => null,
			'db_username' => null,
			'db_password' => null
		];

		$connection = new TestConnector(array_merge($default, $params));

		try{

			$connection->isWorking();

			$this->status = true;
			$this->result = trans('collejo::setup.check_db.success');
			$this->help = '';

		} catch(PDOException $e) {

			$this->status = false;
			$this->result = trans('collejo::setup.check_db.fail');
			$this->help = trans('collejo::common.server_responded', ['msg' => $e->getMessage()]);

		}

		$this->description = trans('collejo::setup.check_db.info');

		return $this;
	}
}