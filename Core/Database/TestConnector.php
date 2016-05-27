<?php

namespace Collejo\Core\Database;

use Config;
use DB;

class TestConnector {

	protected $database;

	protected $connection;

	public function __construct($options = null)
	{
		$database = $options['database'];
		$this->database = $database;

		$driver  = isset($options['driver']) ? $options['driver'] : Config::get("database.default");

		$default = Config::get("database.connections.$driver");

		foreach($default as $item => $value) {
			$default[$item] = isset($options[$item]) ? $options[$item] : $default[$item];
		}

		Config::set("database.connections.$database", $default);

		$this->connection = DB::connection($database);
	}

	public function isWorking()
	{
		return $this->getConnection()->select('SHOW TABLES');
	}

	public function getConnection()
	{
		return $this->connection;
	}

	public function getTable($table = null)
	{
		return $this->getConnection()->table($table);
	}
}
