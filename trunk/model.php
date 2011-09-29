<?php

class		model
{
  protected	$db;

  public function __construct($class)
  {
    $this->db = $class['db'];
    $this->db->getInstance(DB_HOST, DB_USER, DB_PASSW, DB_BASE);
  }
}
?>