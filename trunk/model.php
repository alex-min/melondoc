<?php

class		model
{
  protected	$db;

  public function __construct()
  {
    $this->db = new db;
    $this->db->getInstance(DB_HOST, DB_USER, DB_PASSW, DB_BASE);
  }
}
?>