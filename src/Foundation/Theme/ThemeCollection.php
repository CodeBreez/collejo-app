<?php

namespace Collejo\App\Foundation\Theme;

use Collejo\App\Contracts\Theme\Theme as ThemeInterface;
use Collejo\App\Foundation\Util\ComponentCollection;
use Theme;

class ThemeCollection extends ComponentCollection
{
    public function current()
    {
        if (config('collejo.assets.theme')) {
            return $this->items->find(config('collejo.assets.theme'));
        }
    }

    public function loadThemes()
    {
        $themesPath = realpath(base_path('themes'));

        if (file_exists($themesPath)) {
            foreach ($this->scandir($themesPath) as $dir) {
                $themeFile = $themesPath.'/'.$dir.'/theme.json';

                if (file_exists($themeFile) && ($themeData = file_get_contents($themeFile)) && is_object($theme = json_decode($themeData))) {
                    $themeSettings = (object) array_merge([
                        'name'            => $dir,
                        'overrideDefault' => false,
                        'themeName'       => $dir,
                        'styles'          => [],
                    ], (array) $theme);

                    $theme = app()->make(ThemeInterface::class);

                    $theme->name = $dir;
                    $theme->overrideDefault = $themeSettings->overrideDefault;
                    $theme->styles = $themeSettings->styles;

                    Theme::add($theme);
                }
            }
        }
    }
}
