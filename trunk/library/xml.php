<?php
class			xml
{
  private		$class;

  public function	__construct($class)
  {
    foreach ($class AS $key => $value)
      $this->$key = $value;    
  }

  public function __get($key)
  {
    return (isset($this->class[$key])) ? $this->class[$key] : NULL;
  }

  public function __set($key, $val)
  {
    $this->class[$key] = $val;
  }

  
}
?>