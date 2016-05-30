<?php 

namespace Collejo\Http\Controllers\Setup;

use Collejo\Http\Controllers\Controller as BaseController;
use Request;
use Collejo\Core\Foundation\Setup\Checkup\CheckDB;
use Collejo\Core\Foundation\Setup;
use Session;
use Collejo\Repository\UserRepository;

class SetupController extends BaseController
{

	public function getDone()
	{
		return $this->printJson(true, ['html' => view('collejo::setup.partials.done')->render()]);
	}

	public function getRunStep($step = null, $param1 = null, $param2 = null)
	{
		return $this->printJson(true, $this->setup->processStep($step, $param1, $param2));
	}	

	public function postAdmin(Request $request)
	{
		Session::put('setup-admin-data', [
				'admin_first_name' => $request::get('first_name'),
				'admin_last_name' => $request::get('last_name'),
				'admin_email' => $request::get('email'),
				'admin_password' => $request::get('password')
			]);

		return $this->printJson(true, ['html' => view('collejo::setup.partials.progress')->render()]);
	}

	public function getAdmin()
	{
		return $this->printJson(true, ['html' => view('collejo::setup.partials.admin_user')->render()]);
	}

	public function getPreCheck()
	{
		return $this->printJson(true, ['html' => view('collejo::setup.partials.check_permissions', [
				'results' => $this->setup->preCheckup()
			])->render()]);
	}

	public function postDbConfig(Request $request)
	{
		$dbData = [
			'db_host' => $request::get('host'),
			'db_port' => $request::get('port'),
			'db_database' => $request::get('db'),
			'db_username' => $request::get('u'),
			'db_password' => $request::get('p')
		];

		$checkup = new CheckDB();

		$checkup->run($dbData);

		if ($checkup->isPassed()) {

			Session::put('setup-db-data', $dbData);

			return $this->getPreCheck();

		} else {

			return $this->printJson(false, [], $checkup->getError());
		}
	}

	public function getDbConfig()
	{
		return $this->printJson(true, ['html' => view('collejo::setup.partials.db_credentials')->render()]);
	}

	public function getIndex(Request $request)
	{
		if ($request::ajax()) {
			return $this->printJson(true, ['html' => view('collejo::setup..partials.welcome')->render()]);
		} else {
			return view('collejo::setup.index');
		}
	}

	private function getSetupData()
	{
		return array_merge((array) Session::get('setup-db-data'), (array) Session::get('setup-admin-data'));
	}

	public function __construct(Setup $setup)
	{
		$this->setup = $setup->setSetupData($this->getSetupData());
	}
}
