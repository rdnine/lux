<?php

// Web routes here

use Core\Router as Router;
use App\Controllers\Web as Web;

Router::get('/', function() {
  Web\IndexController::index();
});
