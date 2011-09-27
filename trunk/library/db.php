<?php

class		db
{
  private		$_serveur;
  private		$_user;
  private		$_pass;
  private    static	$_db = false;
  private		$class;

  // ici on fait un multi ton
  public function __construct($class) {
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

  private function connect($serveur, $user, $pass, $bd)
  {
    $this->_db = mysql_connect($serveur, $user, $pass);    
    if (!$this->_db) {
      error::ErrorSQL("Echec de connection a la base sql");
    }
    if (!mysql_select_db($bd)) {
      error::ErrorSQL("Echec de connection a la base sql");
    }
    return ($this->_db);
  }

  public function getInstance($serveur, $user, $pass, $bd)
  {
    if (!isset($this->_db)) {
      $this->connect($serveur, $user, $pass, $bd);
    }
    return ($this->_db);
  }
  // \multi ton

  public function getLastId() // permet de recuperer la derniere clef primaire insere via mysql_insert_id();
  {
    return (mysql_insert_id($this->_db));
  }

  // @return 
  public function query($query) //
  {
    $res = mysql_query($query);
    if (!$res) {
      error::ErrorSQL("Erreur base sql");
    }    
    $ret = new stdClass;
    $ret->count = mysql_num_rows($res);
    $ret->query = $res;
    $ret->rows = array();
    $i = 0;
    while ($ret->rows[$i] = mysql_fetch_row($res)) {
      ++$i;
    }
    return ($ret);
  }

  public function escape($value) {mysql_real_escape_string($value);} //mysql_real_escape_string
  public function escape_html($value) {htmlentities($value);} // htmlentities
}
?>