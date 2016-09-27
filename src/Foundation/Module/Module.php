<?php 

namespace Collejo\App\Foundation\Module;

use Collejo\App\Contracts\Repository\UserRepository;
use Illuminate\Contracts\Support\Arrayable;

class Module implements Arrayable {

	public $name;

	public $displayName;

	public $provider;

	public $path;

	private function permissions()
	{
		$userRepository = app()->make(UserRepository::class);

		return $userRepository->getPermissionsByModule($this->name);
	}

	public function __get($req)
	{
		if (property_exists($this, $req)) {

			return $this->$req;

		} elseif(method_exists($this, $req)) {

			return $this->$req();
		}
	}

	public function toArray()
	{
		return [
			'name' => $this->name,
			'displayName' => $this->displayName,
			'provider' => $this->provider,
			'path' => $this->path
		];
	}
}