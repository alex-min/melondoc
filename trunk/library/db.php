<?php

class		db
{
  private		$_serveur;
  private		$_user;
  private		$_pass;
  private    static	$_db = false;

  // ici on fait un multi ton
  public function __construct() {
  }

  private function connect($serveur, $user, $pass, $bd)
  {
    $this->_db = mysql_connect($serveur, $user, $pass);    
    if (!$this->_db) {
      errorMVC::errorSQL("Echec de connection a la base sql");
    }
    if (!mysql_select_db($bd)) {
      errorMVC::errorSQL("Echec de connection a la base sql");
    }
    return ($this->_db);
  }
  public function getInstance($serveur, $user, $pass, $bd)
  {
    if (!isset($this->_db)) {
      self::connect($serveur, $user, $pass, $bd);
    }
    return ($this->_db);
  }
  // \multi ton

  public function getLastId() // permet de recuperer la derniere clef primaire insere via mysql_insert_id();
  {
    return (mysql_insert_id($this->_db));
  }

  public function select($query) //
  {
    $res = mysql_query($query);
    if (!$res) {
      errorMVC::errorSQL("Erreur base sql");
    }
    
  }

  public function delete() // surcouche pour delete
  {

  }
  
  public function insert() // surcouche pour insert
  {

  }

  public function update() // surcouche pour  update
  {

  }

  public function escape($value) {mysql_real_escape_string($value);} //mysql_real_escape_string
  public function escape_html($value) {htmlentities($value);} // htmlentities
}
?>