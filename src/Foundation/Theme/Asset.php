<?php 

namespace Collejo\App\Foundation\Theme;

class Asset {

	public static $styles = [
		'/css/collejo.css'
	];

	public static $scripts = [
		'/js/collejo.js'
	];

	public static function renderAssets()
	{
		foreach (self::$styles as $file) {
			echo self::getStyleTag($file);
		}

		foreach (self::$scripts as $file) {
			echo self::getScriptTag($file);
		}
	}

	private static function getStyleTag($file)
	{
		return '<link rel="stylesheet" href="' . (config('collejo.assets.minified') ? asset(elixir($file)) : asset($file)) . '">';
	}

	private static function getScriptTag($file)
	{
		return '<script type="text/javascript" src="' . (config('collejo.assets.minified') ? asset(elixir($file)) : asset($file)) . '"></script>';
	}

}