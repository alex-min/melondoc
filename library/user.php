<?php
class user
{
  private $class;
  private $user_rights;
  
  public function __construct() {
  }

  public function loadLib($class) {
    if (is_array($class))
      foreach ($class AS $key => $value)
	$this->$key = $value;
  }
  
  public function __get($key)
  {
    return ((isset($this->class[$key])) ? $this->class[$key] : NULL);
  }

  public function __set($key, $val)
  {
    $this->class[$key] = $val;
  }

  public function addUser($array)
  {
    // `firstname` = "'.$array['form_first_name'].'", `lastname` = "'.$array['form_last_name'].'",
    $this->db->query('INSERT INTO `users` SET `login` = "'.$array['form_login'].'", `mail` = "'.$array['form_email'].'", `password` = "'.md5(SALT.$array['form_mdp']).'", `forum_rights` = "user"');
    return $this->db->getLastId();
  }

  public function deleteUser($id)
  {
    $this->db->query("DELETE FROM `users` WHERE id_user = '".$id."'");
  }
  

  // si le mec n'est pas loggue, on le redirige vers la page de connection
  // sinon on fait rien
  public function needLogin($type = 0)
  {
    if (!isset($_SESSION['user']) ||
	(isset($_SESSION['user']) && $type == 1 && $_SESSION['user']['isAdmin'] == 0))
	{
	  $this->template->loadLanguage("header");
	  $this->template->redirect($this->template->language['header_need_login'], TRUE,"/index/index");
	}
  }

  // recupere les donnees de l'user a mettre en session dans $_SESSION['user'], (pas le mdp),


  public function	connectFB($uid)
  {
    $query = $this->db->query('SELECT * FROM `users` WHERE `facebook_id` = "'.$uid.'" LIMIT 1');
    if ($query->count == 1)
      {
	$_SESSION['user'] = $query->row;
	$this->stockMyRights();
	unset($_SESSION['user']['password']);
	return true;
      }
    return false;    
  }


  // return true si ca a fonctionne, return false si ca a merde
  public function connectUser($email, $password)
  {
    $password = md5(SALT.$password);

    $email = mysql_real_escape_string($email);
    $query = $this->db->query('SELECT * FROM `users` WHERE (`mail` = "'.$email.'" OR `login` = "'.$email.'") AND `password` = "'.$password.'" LIMIT 1');
    if ($query->count == 1)
      {
	$_SESSION['user'] = $query->row;
	$this->stockMyRights();
	unset($_SESSION['user']['password']);
	return true;
      }
    return false;
  }
  
  private function	stockMyRights()
  {
    $_SESSION['user']['rights'] = $this->getRights($_SESSION['user']['user_id']);
  }
  
  public function	getRights($user_id)
  {
    $array = FALSE;
    $query = $this->db->query('SELECT * FROM `users_rights` WHERE `user_id` = "'.$user_id.'"');
    if ($query->count > 0)
      {
	foreach ($query->rows AS $right)
	  $array[$right['document_id']] = $right['user_right'];
      }
    // ajouter les droits de tes groupes ...
    //    $query = $this->db->query('SELECT ');
    return $array;
  }
  
  public function	convertRight($right)
  {
    $this->template->loadLanguage("header");
    switch ($right)
      {
      case "owner":
	return $this->template->language['header_owner'];
      case "read":
	return $this->template->language['header_read'];
      case "write":
	return $this->template->language['header_write'];
      }
    return "NULL";
  }

  public function	hasRight($doc_id, $type = "owner")
  {
    if (isset($_SESSION['user']['rights'][$doc_id]) && $_SESSION['user']['rights'][$doc_id] == $type)
      return TRUE;
    return FALSE;
  }
  
  public function	getRight($doc_id)
  {
    if (isset($_SESSION['user']['rights'][$doc_id]))
      return $_SESSION['user']['rights'][$doc_id];
    return FALSE;
  }

  public function getUserFromID($user_id)
  {
    $query = $this->db->query('SELECT * FROM `users` WHERE `user_id` = "'.$user_id.'" LIMIT 1');
    if ($query->count == 1)
      return $query->row;
    return FALSE;
  }
  public function getGroupFromID($user_id)
  {
    $query = $this->db->query('SELECT * FROM `groups` WHERE `id_group` = "'.$user_id.'" LIMIT 1');
    if ($query->count == 1)
      return $query->row;
    return FALSE;
  }

  // return TRUE ou FALSE si le mec est loggue, check $_SESSION['user']
  public function isLogged()
  {
    return ((isset($_SESSION['user'])) ? TRUE : FALSE);
  }

  // session_destroy et redirection vers l'accueil : $this->template->redirect (voir prototypage)
  public function disconnectUser()
  {
    session_destroy();
    $this->template->redirect("", TRUE, "/index/index");
  }
  
}
?>