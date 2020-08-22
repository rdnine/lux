<?php

namespace App\Controllers\Web;

use Core\View as View;
use App\Controllers\Controller as Controller;

class IndexController extends Controller
{
  private function __construct() {}

  public static function index()
  {    
    View::render(["hello-world" => "Welcome to Lux!"], View::load("index.html"));
  }
}