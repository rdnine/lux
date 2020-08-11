<?php

namespace Core;

class Router
{
  private static $HttpMethods = ['GET', 'POST', 'PUT', 'DELETE'];
  private static $routes = [];

  const VARIABLE_REGEX =
    "~\{
    \s* ([a-zA-Z0-9_]*) \s*
    (?:
        : \s* ([^{]+(?:\{.*?\})?)
    )?
\}\??~x";

    const DEFAULT_DISPATCH_REGEX = '[^/]+';

    const REGEX_SHORTCUTS = array(
        ':i}'  => ':[0-9]+}',
        ':a}'  => ':[0-9A-Za-z]+}',
        ':h}'  => ':[0-9A-Fa-f]+}',
        ':c}'  => ':[a-zA-Z0-9+_\-\.]+}'
    );

    private static $routeExists = false;

    private static $parts;

    private static $reverseParts;

    private static $partsCounter;

    private static $variables;

    private static $regexOffset;

    public function __construct($base = "/") {
      $this->run($base);

    }

    public static function __callStatic($method, $args)
    {   
      
      list($route, $callback) = $args;
      
      if (!in_array(strtoupper($method), self::$HttpMethods)) {
        echo "not exists";
          
      }

      list($routeData, $reverseData) = self::parse($route);

      self::set($method, self::formatRoute($routeData[0]), $callback, isset($routeData[1]) ? $routeData[1] : []);
    }

    public function set(string $method, string $path, \Closure $fn, array $variables = [])
    {

         if (!self::hasRoute($path)) {
            self::$routes[$method][$path] = [$fn, $variables];
        }
    }

    public function hasRoute(string $path): bool
    {
        return array_key_exists($path, self::$routes);
    }

    private function formatRoute($route)
    {
        if ($route !== "/") {
            $result = ltrim($route, '/');
            $result = rtrim($result, '/');

            return $result;
        } else {
            return "/";
        }
    }

    private function extractVariableRouteParts($route)
    {
        if (preg_match_all(self::VARIABLE_REGEX, $route, $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER)) {
            return $matches;
        }
    }

    public function parse($route)
    {
        self::reset();

        $route = strtr($route, self::REGEX_SHORTCUTS);

        if (!$matches = self::extractVariableRouteParts($route)) {
            $reverse = array(
                'variable'  => false,
                'value'     => $route
            );

            return [[$route], array($reverse)];
        }

        foreach ($matches as $set) {

            self::staticParts($route, $set[0][1]);

            self::validateVariable($set[1][0]);

            $regexPart = (isset($set[2]) ? trim($set[2][0]) : self::DEFAULT_DISPATCH_REGEX);

            self::$regexOffset = $set[0][1] + strlen($set[0][0]);

            $match = '(' . $regexPart . ')';

            $isOptional = substr($set[0][0], -1) === '?';

            if ($isOptional) {
                $match = self::makeOptional($match);
            }

            self::$reverseParts[self::$partsCounter] = array(
                'variable'  => true,
                'optional'  => $isOptional,
                'name'      => $set[1][0]
            );

            self::$parts[self::$partsCounter++] = $match;
        }

        self::staticParts($route, strlen($route));

        return [[implode('', self::$parts), self::$variables], array_values(self::$reverseParts)];
    }

    private function staticParts($route, $nextOffset)
    {
        $static = preg_split('~(/)~u', substr($route, self::$regexOffset, $nextOffset - self::$regexOffset), 0, PREG_SPLIT_DELIM_CAPTURE);

        foreach ($static as $staticPart) {
            if ($staticPart) {
                $quotedPart = self::quote($staticPart);

                self::$parts[self::$partsCounter] = $quotedPart;

                self::$reverseParts[self::$partsCounter] = array(
                    'variable'  => false,
                    'value'     => $staticPart
                );

                self::$partsCounter++;
            }
        }
    }

     private function validateVariable($varName)
    {
        if (isset(self::$variables[$varName])) {
            Errors::BadRoute("Cannot use the same placeholder '$varName' twice");
        }

        self::$variables[$varName] = $varName;
    }

    private function makeOptional($match)
    {
        $previous = self::$partsCounter - 1;

        if (isset(self::$parts[$previous]) && self::$parts[$previous] === '/') {
            self::$partsCounter--;
            $match = '(?:/' . $match . ')';
        }

        return $match . '?';
    }

    private function quote($part)
    {
        return preg_quote($part, '~');
    }

    private function reset()
    {
        self::$parts = array();

        self::$reverseParts = array();

        self::$partsCounter = 0;

        self::$variables = array();

        self::$regexOffset = 0;
    }

    function run($base = "/", $trailing_slash_matters = false)
    {
      if(!empty(self::$routes)) {        
        $request = str_replace(
          $base, 
          "", 
          (isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"]: "/")
        );

          if($request !== "" && $request !== "/") {
              if ($trailing_slash_matters || $request === $base) {
                  $path = ltrim($request, "/");
              } else {
                  $path = ltrim($request, "/");
                  $path = rtrim($path, '/');
              }
          } else {
              $path = "/";
          }

          // Get current request method
          $method = strtolower($_SERVER['REQUEST_METHOD']);
          
          if (array_key_exists($method, self::$routes)) {
            foreach (self::$routes[$method] as $expression => $args) {
              $expression = '^' . $expression . '$';

              $fn =  $args[0];
              $variables = $args[1];
              
              if(preg_match("#" . $expression . "#", $path, $matches)) {
                  array_shift($matches);
                  call_user_func_array($fn, $matches);

                  self::$routeExists = true;

                  break;
              }
            }

            if(!self::$routeExists) {
              http_response_code(404);
              echo file_get_contents(ERRORS . '404.html');
            }
          } else {

            http_response_code(500);
            throw new \Exception("No available Method!");
          }
        }
      }
}
