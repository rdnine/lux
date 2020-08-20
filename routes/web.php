<?php

// Web routes here

use Core\Router as Router;
use App\Controllers;

Router::get('/', function() {
  Controllers\PageController::index();
});

Router::get('{lg}/', function() {
  Controllers\PageController::index();
});

Router::get('{lg}/{page}/', function($lg, $page) {
  Controllers\PageController::unknown($lg, $page);
});