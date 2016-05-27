<?php

namespace Collejo\Core\Foundation\Setup;

use Collejo\Core\Contracts\Setup\Checkup as CheckupContract;

abstract class Checkup implements CheckupContract {

	public $status;

	public $description;

	public $result;

	public $help;

	public function getReport()
	{
		return (object) $this->toArray();
	}

	public function getError()
	{
		return $this->help;
	}

	public function isPassed()
	{
		return $this->status;
	}

	public function toArray()
	{
		return [
			'status' => $this->status,
			'description' => $this->description,
			'result' => $this->result,
			'help' => $this->help
		];
	}
}