<?php
class user
{
  private $class;
  
  public function __construct($class)
  {
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

  private function isLoginUsed($login)
  {
    $handler = $this->db->query("SELECT * FROM users WHERE login = $login");
    if($handler->count == 0)
    	return (FALSE);
    return (TRUE);
  }

  public function addUser($login, $firstName, $LastName, $mail, $password)
  {
  	//if (!isLoginUsed($this->login))
  		$this->db->query("INSERT INTO users SET login = $login, firstname = $firstname, lastname = $lastName, mail = $mail, password = $password, forum_rights = $rights");
  }
  
  public function deleteUser($id)
  {
    $this->db->query("DELETE FROM users WHERE id_user = $id");
  }
  

  // si le mec n'est pas loggue, on le redirige vers la page de connection
  // sinon on fait rien
  public function needLogin($rightsNeeded)
  {
    if (! isset($_SESSION['user']) & $_SESSION['user']['rights'] >= $rightsNeeded)
      $this->template->redirect("", FALSE,"/login/index");
  }

  // recupere les donnees de l'user a mettre en session dans $_SESSION['user'], (pas le mdp),
  // return true si ca a fonctionne, return false si ca a merde
  public function connectUser($login, $password)
  {
    $handler = $this->db->query('SELECT * FROM users WHERE login = "$login" AND password = "$password"');
	 if($handler->count == 0)
	 	return (FALSE);
	 $_SESSION['user']['login'] = $handler->rows['login'];
	 $_SESSION['user']['firstname'] = $handler->rows['firstname'];
	 $_SESSION['user']['lastname'] = $handler->rows['lastname'];
	 $_SESSION['user']['rights'] = $handler->rows['rights'];
	 return TRUE;
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
    $this->template->redirect("", TRUE, "/login/index");
  }
  
}
?>