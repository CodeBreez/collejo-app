<?php 

namespace Collejo\App\Foundation;

use Illuminate\Foundation\Application as BaseApplication;
use DB;
use ReflectionClass;
use Illuminate\Foundation\AliasLoader;

class Application extends BaseApplication {

	const VERSION = '1.0.0';

	public $majorUserRoles = ['admin', 'student', 'employee', 'guardian'];

	public function isInstalled()
	{
		try {
			return (bool) DB::select('select migration from migrations');

		} catch (\Exception $e) {

			return false;

		}
	}

	public function langPath() {

		$reflection = new ReflectionClass('Collejo\App\Providers\AppServiceProvider');

		$pathinfo = pathinfo($reflection->getFileName());

        return realpath($pathinfo['dirname'] . '/../resources/lang');
    }

    public function boot()
    {
    	$this->registerIlluminateProviders();
    	$this->registerCollejoProviders();
    	$this->registerAliases();

    	parent::boot();
    }

    private function registerAliases()
    {
    	$aliases = [
	        'App' => 'Illuminate\Support\Facades\App',
	        'Artisan' => 'Illuminate\Support\Facades\Artisan',
	        'Auth' => 'Illuminate\Support\Facades\Auth',
	        'Blade' => 'Illuminate\Support\Facades\Blade',
	        'Cache' => 'Illuminate\Support\Facades\Cache',
	        'Config' => 'Illuminate\Support\Facades\Config',
	        'Cookie' => 'Illuminate\Support\Facades\Cookie',
	        'Crypt' => 'Illuminate\Support\Facades\Crypt',
	        'DB' => 'Illuminate\Support\Facades\DB',
	        'Eloquent' => 'Collejo\App\Database\Eloquent\Model',
	        'Event' => 'Illuminate\Support\Facades\Event',
	        'File' => 'Illuminate\Support\Facades\File',
	        'Gate' => 'Illuminate\Support\Facades\Gate',
	        'Hash' => 'Illuminate\Support\Facades\Hash',
	        'Lang' => 'Illuminate\Support\Facades\Lang',
	        'Log' => 'Illuminate\Support\Facades\Log',
	        'Mail' => 'Illuminate\Support\Facades\Mail',
	        'Password' => 'Illuminate\Support\Facades\Password',
	        'Queue' => 'Illuminate\Support\Facades\Queue',
	        'Redirect' => 'Illuminate\Support\Facades\Redirect',
	        'Redis' => 'Illuminate\Support\Facades\Redis',
	        'Request' => 'Illuminate\Support\Facades\Request',
	        'Response' => 'Illuminate\Support\Facades\Response',
	        'Route' => 'Illuminate\Support\Facades\Route',
	        'Schema' => 'Illuminate\Support\Facades\Schema',
	        'Session' => 'Illuminate\Support\Facades\Session',
	        'Storage' => 'Illuminate\Support\Facades\Storage',
	        'URL' => 'Illuminate\Support\Facades\URL',
	        'Validator' => 'Illuminate\Support\Facades\Validator',
	        'View' => 'Illuminate\Support\Facades\View',

	        'Module' => 'Collejo\App\Support\Facades\Module',
	        'Widget' => 'Collejo\App\Support\Facades\Widget',
	        'Theme' => 'Collejo\App\Support\Facades\Theme',
	        'Menu' => 'Collejo\App\Support\Facades\Menu',
	        'Asset' => 'Collejo\App\Foundation\Theme\Asset',
	        'Uploader' => 'Collejo\App\Foundation\Media\Uploader',

	        'Uuid' => 'Webpatser\Uuid\Uuid',
	        'Carbon' => 'Carbon\Carbon',
	        'Active' => 'HieuLe\Active\Facades\Active',
	        'Image' => 'Intervention\Image\Facades\Image'
    	];

    	$loader = AliasLoader::getInstance();

    	foreach ($aliases as $key => $alias) {
    		$loader->alias($key, $alias);
    	}
    }

    private function registerCollejoProviders()
    {
    	$providers = [        
			'Collejo\App\Providers\AppServiceProvider',
	        'Collejo\App\Providers\AuthServiceProvider',
	        'Collejo\App\Providers\EventServiceProvider',
	        'Collejo\App\Providers\RouteServiceProvider',
	        'Collejo\App\Providers\ModuleServiceProvider',
	        'Collejo\App\Providers\ThemeServiceProvider',
	        'Collejo\App\Providers\MediaServiceProvider',
	        'Collejo\App\Providers\WidgetServiceProvider',
	        'Clockwork\Support\Laravel\ClockworkServiceProvider',
	        'HieuLe\Active\ActiveServiceProvider',
	        'Intervention\Image\ImageServiceProvider'
	    ];

	    foreach ($providers as $provider) {
	    	$this->register($provider);
	    }
    }

    private function registerIlluminateProviders()
    {
    	$providers = [        
	    	'Illuminate\Auth\AuthServiceProvider',
	        'Illuminate\Broadcasting\BroadcastServiceProvider',
	        'Illuminate\Bus\BusServiceProvider',
	        'Illuminate\Cache\CacheServiceProvider',
	        'Illuminate\Foundation\Providers\ConsoleSupportServiceProvider',
	        'Illuminate\Cookie\CookieServiceProvider',
	        'Illuminate\Database\DatabaseServiceProvider',
	        'Illuminate\Encryption\EncryptionServiceProvider',
	        'Illuminate\Filesystem\FilesystemServiceProvider',
	        'Illuminate\Foundation\Providers\FoundationServiceProvider',
	        'Illuminate\Hashing\HashServiceProvider',
	        'Illuminate\Mail\MailServiceProvider',
	        'Illuminate\Pagination\PaginationServiceProvider',
	        'Illuminate\Pipeline\PipelineServiceProvider',
	        'Illuminate\Queue\QueueServiceProvider',
	        'Illuminate\Redis\RedisServiceProvider',
	        'Illuminate\Auth\Passwords\PasswordResetServiceProvider',
	        'Illuminate\Session\SessionServiceProvider',
	        'Illuminate\Translation\TranslationServiceProvider',
	        'Illuminate\Validation\ValidationServiceProvider',
	        'Illuminate\View\ViewServiceProvider'
	    ];

	    foreach ($providers as $provider) {
	    	$this->register($provider);
	    }
    }
}