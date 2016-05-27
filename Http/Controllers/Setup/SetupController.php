<?php 

namespace Collejo\Http\Controllers\Setup;

use Collejo\Http\Controllers\Controller as BaseController;
use Request;
use Collejo\Core\Foundation\Setup\Checkup\CheckDB;
use Collejo\Core\Foundation\Setup;
use Session;

class SetupController extends BaseController
{

	public function copyMigrations()
	{
		$setup = new Setup((array) Session::get('setup-db-data'));

		return $this->printJson(true, $setup->copyMigrations());
	}

	public function postAdmin(Request $request)
	{
		Session::put('setup-admin-data', [
				'first_name' => $request::get('first_name'),
				'last_name' => $request::get('last_name'),
				'email' => $request::get('email'),
				'password' => $request::get('password')
			]);

		return $this->printJson(true, ['html' => view('collejo::setup.partials.progress')->render()]);
	}

	public function getAdmin()
	{
		return $this->printJson(true, ['html' => view('collejo::setup.partials.admin_user')->render()]);
	}

	public function getPreCheck()
	{
		$setup = new Setup((array) Session::get('setup-db-data'));

		return $this->printJson(true, ['html' => view('collejo::setup.partials.check_permissions', [
				'results' => $setup->preCheckup()
			])->render()]);
	}

	public function postDbConfig(Request $request)
	{
		$dbData = [
			'host' => $request::get('host'),
			'port' => $request::get('port'),
			'database' => $request::get('db'),
			'username' => $request::get('u'),
			'password' => $request::get('p')
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

	public function index(Request $request)
	{
		if ($request::ajax()) {
			return $this->printJson(true, ['html' => view('collejo::setup..partials.welcome')->render()]);
		} else {
			return view('collejo::setup.index');
		}
	}

	private function checkPermissions()
	{
		return (object)[
			'canContinue' => true,
			'report' => [
				(object)[
					'name' => '.env file writable',
					'success' => true,
					'description' => 'werjlwke rljwekj r'
				], (object)[
					'name' => 'resource dir writable',
					'success' => false,
					'description' => 'werjlwke rljwekj r'
				], (object)[
					'name' => 'modules dir writable',
					'success' => false,
					'description' => 'werjlwke rljwekj r'
				], (object)[
					'name' => 'public dir writable',
					'success' => false,
					'description' => 'werjlwke rljwekj r'
				]
			]
		];
	}
}
