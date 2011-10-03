<?php
class user
{
  private $id;
  private $firstName;
  private $lastName;
  private $nickname;
  private $mail;
  private $connnected;
  private $db;
  private $rights;
  private $password;
  private $class;
  
  public function __construct($class)
  {
    $this->db = $class['db'];
    $this->KLogger = $class['KLogger'];
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

  public function addUser($login, $firstName, $LastName, $mail, $password)
  {
    $this->db->query("insert into users set login = $this->nickname, firstname = $this->firstName, lastname = $this->lastName, mail = $this->mail, password = $this->password, forum_rights = $this->rights");
  }
  
  public function deleteUser()
  {
    $this->db->query("");
  }
  

  // si le mec n'est pas loggue, on le redirige vers la page de connection
  // sinon on fait rien
  public function needLogin()
  {
    
  }

  // recupere les donnees de l'user a mettre en session dans $_SESSION['user'], (pas le mdp),
  // return true si ca a fonctionne, return false si ca a merde
  public function connectUser()
  {
    
  }
  
  // return TRUE ou FALSE si le mec est loggue, check $_SESSION['user']
  public function isLogged()
  {
    
  }

  // session_destroy et redirection vers l'accueil : $this->template->redirect (voir prototypage)
  public function disconnectUser()
  {
  }
  
}
?>