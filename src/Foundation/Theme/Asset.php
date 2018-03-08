<?php

namespace Collejo\App\Foundation\Theme;

use Theme as ThemeCollection;

class Asset
{
    public static $styles = [
        '/css/collejo.css',
    ];

    public static $scripts = [
        '/js/collejo.js',
    ];

    public static function renderStyles()
    {
        if (ThemeCollection::current()) {
            self::$styles = ThemeCollection::current()->getStyles()->map(function ($style) {
                return '/themes/'.ThemeCollection::current()->name.'/css/'.$style;
            })->all();
        }

        foreach (self::$styles as $file) {
            echo self::getStyleTag(config('collejo.assets.minified') ? asset(elixir($file)) : asset($file));
        }
    }

    public static function renderScripts()
    {
        foreach (self::$scripts as $file) {
            echo self::getScriptTag(config('collejo.assets.minified') ? asset(elixir($file)) : asset($file));
        }
    }

    private static function getStyleTag($file)
    {
        return '<link rel="stylesheet" href="'.$file.'">';
    }

    private static function getScriptTag($file)
    {
        return '<script type="text/javascript" src="'.$file.'"></script>';
    }
}
