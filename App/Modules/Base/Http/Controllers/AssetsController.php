<?php

namespace Collejo\App\Modules\Base\Http\Controllers;

use Cache;
use Collejo\App\Http\Controller;
use Module;

class AssetsController extends Controller
{
    /**
     * Returns a cached array of locales for the application.
     *
     * @return mixed
     */
    public function getLocals()
    {
        $langs = Cache::remember('lang-files', config('languages_cache_ttl'), function () {
            $langs = ['aa' => [], 'ab' => [], 'ae' => [], 'af' => [], 'ak' => [], 'am' => [], 'an' => [], 'ar' => [], 'as' => [], 'av' => [], 'ay' => [], 'az' => [], 'ba' => [], 'be' => [], 'bg' => [], 'bh' => [], 'bi' => [], 'bm' => [], 'bn' => [], 'bo' => [], 'br' => [], 'bs' => [], 'ca' => [], 'ce' => [], 'ch' => [], 'co' => [], 'cr' => [], 'cs' => [], 'cu' => [], 'cv' => [], 'cy' => [], 'da' => [], 'de' => [], 'dv' => [], 'dz' => [], 'ee' => [], 'el' => [], 'en' => [], 'eo' => [], 'es' => [], 'et' => [], 'eu' => [], 'fa' => [], 'ff' => [], 'fi' => [], 'fj' => [], 'fo' => [], 'fr' => [], 'fy' => [], 'ga' => [], 'gd' => [], 'gl' => [], 'gn' => [], 'gu' => [], 'gv' => [], 'ha' => [], 'he' => [], 'hi' => [], 'ho' => [], 'hr' => [], 'ht' => [], 'hu' => [], 'hy' => [], 'hz' => [], 'ia' => [], 'id' => [], 'ie' => [], 'ig' => [], 'ii' => [], 'ik' => [], 'io' => [], 'is' => [], 'it' => [], 'iu' => [], 'ja' => [], 'jv' => [], 'ka' => [], 'kg' => [], 'ki' => [], 'kj' => [], 'kk' => [], 'kl' => [], 'km' => [], 'kn' => [], 'ko' => [], 'kr' => [], 'ks' => [], 'ku' => [], 'kv' => [], 'kw' => [], 'ky' => [], 'la' => [], 'lb' => [], 'lg' => [], 'li' => [], 'ln' => [], 'lo' => [], 'lt' => [], 'lu' => [], 'lv' => [], 'mg' => [], 'mh' => [], 'mi' => [], 'mk' => [], 'ml' => [], 'mn' => [], 'mr' => [], 'ms' => [], 'mt' => [], 'my' => [], 'na' => [], 'nb' => [], 'nd' => [], 'ne' => [], 'ng' => [], 'nl' => [], 'nn' => [], 'no' => [], 'nr' => [], 'nv' => [], 'ny' => [], 'oc' => [], 'oj' => [], 'om' => [], 'or' => [], 'os' => [], 'pa' => [], 'pi' => [], 'pl' => [], 'ps' => [], 'pt' => [], 'qu' => [], 'rm' => [], 'rn' => [], 'ro' => [], 'ru' => [], 'rw' => [], 'sa' => [], 'sc' => [], 'sd' => [], 'se' => [], 'sg' => [], 'si' => [], 'sk' => [], 'sl' => [], 'sm' => [], 'sn' => [], 'so' => [], 'sq' => [], 'sr' => [], 'ss' => [], 'st' => [], 'su' => [], 'sv' => [], 'sw' => [], 'ta' => [], 'te' => [], 'tg' => [], 'th' => [], 'ti' => [], 'tk' => [], 'tl' => [], 'tn' => [], 'to' => [], 'tr' => [], 'ts' => [], 'tt' => [], 'tw' => [], 'ty' => [], 'ug' => [], 'uk' => [], 'ur' => [], 'uz' => [], 've' => [], 'vi' => [], 'vo' => [], 'wa' => [], 'wo' => [], 'xh' => [], 'yi' => [], 'yo' => [], 'za' => [], 'zh' => [], 'zu' => []];

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
            ->header('Content-Type:', 'application/javascript');
    }
}
