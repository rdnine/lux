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
| Ignite
|--------------------------------------------------------------------------
|
| Let the Lux guide you! Happy Development
|
*/

$app = new Core\Lux();
