<?php

/*
|--------------------------------------------------------------------------
| Where all begins
--------------------------------------------------------------------------
|
*/

use Core\Config as Config;


$appName = Config('app.name');

Config::alias("db", "database");
Config::alias("lg", "lang");
Config::alias("app", "app");

$cfg = Config::build();

echo $cfg->app->name;
echo '<br>';
echo '<br>';
echo $appName;
