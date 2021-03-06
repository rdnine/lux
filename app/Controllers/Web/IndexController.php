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
    View::render(["head" => self::head(), "hello" => "Welcome to", "lux" => "Lux"], View::load("index.html"));
  }

  public static function homepage($lg) {
    View::render([
      "head" => self::head(),
      "hello" => $lg->slug === "en" ? "Welcome to" : "Bem-vindos ao",
      "lux" => "Lux"],
      View::load("index.html"));
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