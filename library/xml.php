<?php
class			xml
{
  private		$class;

  public function	__construct()
  {
    foreach ($class AS $key => $value)
      $this->$key = $value;    
  }

  private function __get($key)
  {
    return (isset($this->class[$key])) ? $this->class[$key] : NULL;
  }

  private function __set($key, $val)
  {
    $this->class[$key] = $val;
  }

  
}
?>