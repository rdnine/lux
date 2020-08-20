<?php

namespace App\Controllers;

class PageController extends Controller
{
  private function __construct() {}

  public static function index() {
    echo "Homepage";
  }

  public static function unknown($lg, $page) {
    echo "This is {$page} in {$lg}";
  }
}