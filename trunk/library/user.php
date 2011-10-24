<?php
class user
{
  private $class;
  
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
    $this->db->query('INSERT INTO `users` SET `login` = "'.$array['form_login'].'", `firstname` = "'.$array['form_first_name'].'", `lastname` = "'.$array['form_last_name'].'", `mail` = "'.$array['form_email'].'", `password` = "'.md5(SALT.$array['form_mdp']).'", `forum_rights` = "user"');
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
      $this->template->redirect("", FALSE,"/login/index");
    
  }

  // recupere les donnees de l'user a mettre en session dans $_SESSION['user'], (pas le mdp),
  // return true si ca a fonctionne, return false si ca a merde
  public function connectUser($login, $password)
  {
    $password = md5(SALT.$password);
    $login = mysql_real_escape_string($login);
    $quey = $this->db->query('SELECT * FROM `users` WHERE `login` = "'.$login.'" AND `password` = "'.$password.'"');
    if ($quey->count == 1)
      {
	$_SESSION['user'] = $quey->row;
	unset($_SESSION['user']['password']);
	return true;
      }
    return false;
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