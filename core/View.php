<?php

namespace Core;

use Core\Config as Config;

class View
{
    protected static $build = "";

    private function __construct() {}

    public static function load($path)
    {
        if(!is_null($path)) {
            if(file_exists(Config::paths('views') . '/' . $path)) {
                return file_get_contents(Config::paths('views') . '/' . $path);
            }
        }

        throw new \Exception("Error loading view");
    }

    public static function c2r($args = [], $target)
    {
        if(is_array($args)) {
            foreach ($args as $key => $value) {
                $target = str_replace('{{ ' . $key . ' }}', $value, $target);
            }

            return $target;
        }

        return false;
    }

    private static function minifyView($buffer)
    {
		/* origin http://jesin.tk/how-to-use-php-to-minify-html-output/ */
		$search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');

		$replace = array('>', '<', '\\1');

		if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
			$buffer = preg_replace($search, $replace, $buffer);
		}

		$buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);

		return $buffer;
    }

    public static function render($args = [], $tpl = null)
    {
        if(is_array($args) && is_string($tpl)) {
            self::$build = self::c2r($args, $tpl);
        } else {
            self::$build = ".::RENDER::.::ERROR::.";
        }
    }

    public static function build()
    {
        if (!is_null(self::$build) && is_string(self::$build)) {
            echo self::minifyView(self::$build);
        } else {
            echo ".::TEMPLATE::.::ERROR::.";
        }
    }
}