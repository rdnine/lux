<?php

namespace App\Controllers;

use Core\View as View;

class PageController extends Controller
{
  private function __construct() {}

  public static function index()
  {    
    View::render(["hello-world" => "Welcome to Lux!"], View::load("index.html"));
  }
}