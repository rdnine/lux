<?php

namespace App\Controllers\Errors;

use Core\View as View;
use Core\Config as Config;
use App\Controllers\Controller as Controller;

class ExceptionController extends Controller
{
    private function __construct()
    {
        echo ".::EXCENPTIONS HANDLER::.";
    }

    public static function notFound($message = "")
    {
      View::render(["head" => self::head(), "message" => $message], View::load("errors/404.html"));
    }

    private static function head()
    {
      return View::c2r([
      "app-title" => "404 - NOT FOUND | " . Config::app('name'),
      "app-path" => Config::paths('base'),
      "keywords" => "",
      "description" => ""
    ], View::load("components/head.html"));
    }
}