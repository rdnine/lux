<?php

/**
 * Lux - A PHP Micro-Framework for Fast Development
 * 
 * @package Lux
 * @author Rafael Duarte <rafael@rdnine.dev>
 */


/*
|--------------------------------------------------------------------------
| The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for the application. Just sit back and relax
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Path Utilities
|--------------------------------------------------------------------------
|
| Ever felt lost? Say no more to that. We define the paths so the app can quickly run through the maze
|
*/

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "paths.php";

/*
|--------------------------------------------------------------------------
| Ignite
|--------------------------------------------------------------------------
|
| Let the Lux guide you! Happy Development
|
*/

require_once APP . "init.php";