<?php
class			userModel extends model
{
  public function checkUsername($login)
  {
    $query = $this->db->query('SELECT `user_id` FROM `users` WHERE `login` = "'.$login.'"');
    unset($query->rows);
    if ($query->count > 0 || stristr($login, "melondoc") != FALSE || stristr($login, "admin"))
      return FALSE;
    return TRUE;
  }

  public function	addFacebookID($uid, $user_id)
  {
    $this->db->query('UPDATE `users` SET facebook_id = "'.$uid.'" WHERE `user_id` = "'.$user_id.'"');
  }
  public function	emailExist($email)
  {
    $query = $this->db->query('SELECT `user_id` FROM `users` WHERE `mail` = "'.$email.'"');
    if ($query->count > 0)
      return TRUE;
    return FALSE;
  }

  public function saveMessage($from, $sujet, $message)
  {
    $query = "INSERT INTO `message` (`from`, `subject`, `message`) VALUES ('".$from."', '".$sujet."','".$message."')";
    $this->db->query($query);
  }
}
?>