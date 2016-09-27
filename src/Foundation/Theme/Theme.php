<?php 

namespace Collejo\App\Foundation\Theme;

use Collejo\App\Foundation\Util\Component;

class Theme extends Component {

	public $name;

	public $themeName;

	public $overrideDefault;

	public $styles = [];

	public function getStyles()
	{
		return collect($this->styles);
	}

	public function toArray()
	{
		return [
			'name' => $this->name,
			'overrideDefault' => $this->override_default,
			'themeName' => $this->themeName
		];
	}
}