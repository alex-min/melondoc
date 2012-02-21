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
  }
  
  public function deleteUser($id)
  {
    $this->db->query("DELETE FROM `users` WHERE id_user = '".$id."'");
  }
  

  // si le mec n'est pas loggue, on le redirige vers la page de connection
  // sinon on fait rien
  public function needLogin()
  {
    if (!isset($_SESSION['user']))
	{
	  $this->template->loadLanguage("header");
	  $this->template->redirect($this->template->language['header_need_login'], TRUE,"/index/index");
	}
  }

  // recupere les donnees de l'user a mettre en session dans $_SESSION['user'], (pas le mdp),
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
  	$this->user_rights = $this->getRights($_SESSION['user']['user_id']);
  }
  
  public function	getRights($user_id)
  {
  	$array = array();
  	$query = $this->db->query('SELECT * FROM `users_rights` WHERE `user_id` = "'.$user_id.'"');
  	if ($query->count > 0)
	{
		foreach ($query->rows AS $right)
			$array[$right['document_id']] = $right['user_right'];
		return $array;
	}
	return FALSE;
  }
  
  public function	hasRight($doc_id, $type = "owner")
  {
  	if (isset($this->user_rights[$doc_id]) && $this->user_rights[$doc_id] == $type)
		return TRUE;
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