<?php

namespace Collejo\App\Modules\Media\Helpers;

use Exception;

class Bucket {

	public $config;

	public static function find($bucketName)
	{
		$config = config('collejo.file_uploader.buckets.' . $bucketName);

		if (is_null($config)) {

			throw new Exception('specified bucket not found');
		}

		return new Self($config);
	}

	public function __construct($config)
	{
		$this->config = $config;
	}

	public function __call($method, $args)
	{
		if (isset($this->config[camel_case($method)])) {
			return $this->config[camel_case($method)];
		}
	}
}