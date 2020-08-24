<?php

// Web routes here

use Core\Router as Router;
use Core\Config as Config;

use App\Controllers\Web as Web;
use App\Controllers\Errors\ExceptionController as Exception;

Router::get('/', function() {
  Web\IndexController::index();
});

Router::get('/{lg}/home', function($lg) {
  $lg = Config::lg($lg);

  if($lg && $lg->active) {
    Web\IndexController::homepage($lg);
  } else {
    Exception::notFound("Language not found or not active");
  }
});
