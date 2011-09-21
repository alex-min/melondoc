<?php

class		model
{
  protected	$db;

  public function __construct()
  {
    $this->db = database::getInstance(DB_HOST, DB_USER, DB_PASSW, DB_BASE);
  }
}
?>