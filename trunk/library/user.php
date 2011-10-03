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
	public $KLogger;
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
	
	public function getForumRights()
	{
		return $this->rights;
	}
	
	public function getDocumentRights()
	{
		
	}
	
	public function deleteUser()
	{
		$this->db->query("");
	}
	
	public function connectUser()
	{
		
	}
	
	public function disconnectUser()
	{
		
	}
}
?>