<?php

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}

if (!defined('ABSR')) {
    define('ABSR', $_SERVER["DOCUMENT_ROOT"]);
}

if (!defined('SRC')) {
    define('SRC', ROOT . DS . "src" . DS);
}

if (!defined('APP')) {
    define('APP', ROOT . DS . 'app' . DS);
}

if (!defined('CONFIG')) {
    define('CONFIG', APP . 'Config' . DS);
}

if (!defined('CORE')) {
    define('CORE', APP . 'core' . DS);
}

if (!defined('PUBLIC')) {
    define('PUBLIC', ROOT . DS . 'public' . DS);
}

if (!defined('CONTROLLERS')) {
    define('CONTROLLERS', APP . 'Controllers' . DS);
}

if (!defined('VIEWS')) {
    define('VIEWS', SRC . 'views' . DS);
}

if (!defined('ERRORS')) {
    define('ERRORS', VIEWS . 'errors' . DS);
}

if (!defined('MODELS')) {
    define('MODELS', APP . 'Models' . DS);
}

if (!defined('ROUTES')) {
    define('ROUTES', ROOT . DS . 'routes' . DS);
}
