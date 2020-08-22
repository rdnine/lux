<?php

namespace Core;

use Core\Config as Config;
use Core\Router as Router;
use Core\View as View;

class Lux
{

  public $router;

  public $cfg;

  public function __construct() {
    Config::alias("db", "database");
    Config::alias("lg", "lang");
    Config::alias("app", "app");
    Config::alias("paths", "paths");

    $this->cfg = Config::build();

    $this->router = new Router($this->cfg->paths->base);
  }

  public function run()
  {
    View::build();
  }
}