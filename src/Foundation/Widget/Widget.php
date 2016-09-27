<?php 

namespace Collejo\App\Foundation\Widget;

use Illuminate\Contracts\Support\Arrayable;

abstract class Widget implements Arrayable {

	public $location;

	public $permissions = ['view_student_general_details'];

	public $view;

	public function toArray()
	{
		return [
			'location' => $this->location,
			'permissions' => implode(', ', $this->permissions),
			'view' => $this->view,
		];
	}
}