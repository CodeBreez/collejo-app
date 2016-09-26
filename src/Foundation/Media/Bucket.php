<?php 

namespace Collejo\App\Foundation\Media;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Bucket {

	public $config;

	public static function find($bucketName)
	{
		$config = config('uploader.' . $bucketName);

		if (is_null($config)) {
			throw new \Exception('specified bucket not found');
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