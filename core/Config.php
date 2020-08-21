<?php

namespace Core;

class Config
{
  protected $file;
  protected $index;

  protected static $data;
  public $obj;

  public function __construct(string $file, string $index)
  {
    $this->file = $file;
    $this->index = $index;
  }

  public static function __callStatic($name, $args)
  {
    $value = $args[0];
    return self::$data->$name->$value;
  }
  
  function get()
  {
    if($this->exists($this->file)) {

      $obj = include CONFIG . $this->file . ".php";
      
      if($this->has($obj, $this->index)) {
        $key = $this->index;
        return $obj->$key;
      }
  
      throw new \Exception("No such property in the requested config file!");
    }

    throw new \Exception("The requested config file does not exists!");
  }


  function has($obj, $property) {
    if(property_exists($obj, $property)) {
      return true;
    }

    return false;
  }

  function exists($file) {
    if(file_exists(CONFIG . $file . '.php')) {
      return true;
    }

    return false;
  }

  public static function alias($key, $configs) {
    if(!is_object(self::$data)) {
      self::$data = new \StdClass();
    }

    self::$data->$key = include CONFIG . $configs . '.php';
  }

  public static function build() {
    return self::$data;
  }
}
