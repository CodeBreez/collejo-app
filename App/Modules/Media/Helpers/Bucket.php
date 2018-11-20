<?php

namespace Collejo\App\Modules\Media\Helpers;

use Exception;

class Bucket {

	public $config;

    /**
     * Gets a bucket by name
     *
     * @param $bucketName
     * @return Bucket
     * @throws Exception
     */
	public static function find($bucketName)
	{
		$config = config('collejo.file_uploader.buckets.' . $bucketName);

		if (is_null($config)) {

			throw new Exception('specified bucket not found');
		}

		return new Self($config);
	}

    /**
     * Initialize a bucket object
     *
     * Bucket constructor.
     * @param $config
     */
	public function __construct($config)
	{
		$this->config = $config;
	}

    /**
     * Get bucket properties
     *
     * @param $method
     * @param $args
     * @return mixed
     */
	public function __call($method, $args)
	{
		if (isset($this->config[camel_case($method)])) {

			return $this->config[camel_case($method)];
		}
	}
}