<?php

namespace Collejo\Core\Foundation\Setup;

use Illuminate\Support\Collection;

class Report extends Collection {

	public function canContinue()
	{
		foreach ($this as $item) {
			if (!$item->isPassed()) {
				return false;
			}
		}

		return true;
	}

}