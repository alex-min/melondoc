<?php

class		db
{
  private		$_serveur;
  private		$_user;
  private		$_pass;
  private		$_db;
  private static	$_instances = array();

  // ici on fait un multi ton
  public function __construct($serveur, $user, $pass, $db)
  {
    self::getInstance($serveur, $user, $pass, $bd);
  }

  private function connect()
  {

  }

  public static function getInstance($serveur, $user, $pass, $bd)
  {
    
  }
  // \multi ton

  public function getLastId() // permet de recuperer la derniere clef primaire insere via mysql_insert_id();
  {

  }

  public function select() //
  {

  }

  public function delete() // surcouche pour delete
  {

  }
  
  public function insert_update() // surcouche pour insert ou update
  {

  }

  public function escape($value) {} //mysql_real_escape_string
  public function escape_html($value) {} // htmlentities
}
?>