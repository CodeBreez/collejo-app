<?php 

namespace Collejo\Core\Contracts\Setup;

interface Checkup {

	public function run($params = []);

	public function getReport();
}