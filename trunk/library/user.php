<?php
class user
{
	private $id;
	private $firstName;
	private $lastName;
	private $login;
	private $connnected;
	private $db;
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
		$this->db->query('insert into users set');
	}
	
	public function getForumRights()
	{
		
	}
	
	public function getDocumentRights()
	{
		
	}
	
	public function deleteUser()
	{
		
	}
	
	public function connectUser()
	{
		
	}
	
	public function disconnectUser()
	{
		
	}
}
?>