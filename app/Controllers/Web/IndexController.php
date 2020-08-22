<?php

namespace App\Controllers\Web;

use Core\View as View;
use Core\Config as Config;
use App\Controllers\Controller as Controller;

class IndexController extends Controller
{
  private function __construct() {}

  public static function index()
  {    
    View::render(["head" => self::head(), "hello-world" => "Welcome to Lux!"], View::load("index.html"));
  }

  private static function head() {
    return View::c2r([
      "app-title" => Config::app('name'),
      "app-path" => Config::paths('base'),
      "keywords" => "",
      "description" => ""
    ], View::load("components/head.html"));
  }
}