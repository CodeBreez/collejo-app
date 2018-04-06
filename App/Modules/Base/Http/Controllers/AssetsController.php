<?php

namespace Collejo\App\Modules\Base\Http\Controllers;

use Auth;
use Cache;
use Collejo\App\Http\Controller;
use Illuminate\Routing\Router;
use Module;

class AssetsController extends Controller
{
    /**
     * Returns a cached array of routes for the application.
     *
     * @return mixed
     */
    public function getRoutes(Router $router)
    {
        $cacheKey = 'route-files-'.(Auth::user() ? Auth::user()->id : 'guest');

        $routes = Cache::remember($cacheKey, config('routes_cache_ttl'), function () use ($router) {
            $routes = [];

            foreach ($router->getRoutes() as $route) {
                if ($route->getName()) {
                    $routes[] = [
                        'methods' => $route->methods(),
                        'name'    => $route->getName(),
                        'uri'     => $route->uri(),
                    ];
                }
            }

            return $routes;
        });

        return response('C.routes='.json_encode($routes))
            ->header('Cache-Control', 'max-age='.config('routes_cache_ttl'))
            ->header('Content-Type', 'application/javascript');
    }

    /**
     * Returns a cached array of locales for the application.
     *
     * @return mixed
     */
    public function getLocals()
    {
        $langs = Cache::remember('lang-files', config('languages_cache_ttl'), function () {
            $langs = array_fill_keys(config('collejo.languages'), []);

            foreach (Module::getModulePaths() as $path) {
                if (file_exists($path)) {
                    foreach (listDir($path) as $module) {
                        $langDir = $path.'/'.$module.'/resources/lang';

                        if (is_dir($path.'/'.$module) && is_dir($langDir)) {
                            foreach (listDir($langDir) as $lang) {
                                foreach (listDir($langDir.'/'.$lang) as $langFile) {
                                    if (!isset($langs[$lang][strtolower($module)])) {
                                        $langs[$lang][strtolower($module)] = [];
                                    }

                                    $langs[$lang][strtolower($module)][basename($langFile, '.php')] = require $langDir.'/'.$lang.'/'.$langFile;
                                }
                            }
                        }
                    }
                }
            }

            return $langs;
        });

        return response('C.langs='.json_encode($langs))
            ->header('Cache-Control', 'max-age='.config('languages_cache_ttl'))
            ->header('Content-Type', 'application/javascript');
    }
}
