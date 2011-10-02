<?php

class		model
{
  protected	$db;

  /**
   * @fn function __construct($class)
   * @brief 
   * @file model.php
   * 
   * @param class               
   * @return		
   */
  public function __construct($class)
  {
    $this->db = $class['db'];
    $this->db->getInstance(DB_HOST, DB_USER, DB_PASSW, DB_BASE);
  }
}
?>