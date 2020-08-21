<?php

// Web routes here

use Core\Router as Router;
use App\Controllers;

Router::get('/', function() {
  Controllers\PageController::index();
});
