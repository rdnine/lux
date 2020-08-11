<?php

// Web routes here

use Core\Router as Router;

Router::get('/', function() {
  echo "Homepage!";
});

Router::get('{lg}/', function() {
  echo "Homepage!";
});

Router::get('{lg}/{page}/', function($lg, $page) {
  echo "this is {$page} in {$lg}";
});