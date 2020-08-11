<?php

namespace Core;

use Core\Config as Config;
use Core\Router as Router;

class Lux
{

  public $router;

  public $cfg;

  public function __construct() {
    Config::alias("db", "database");
    Config::alias("lg", "lang");
    Config::alias("app", "app");

    $this->cfg = Config::build();

    $this->router = new Router($this->cfg->app->path); 
  }
}