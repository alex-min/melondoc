<?php
class			loginModel extends model
{
  public function checkUsername($login)
  {
    $query = $this->db->query('SELECT `user_id` FROM `users` WHERE `login` = "'.$login.'"');
    unset($query->rows);
    if ($query->count > 0 || stristr($login, "melondoc") != FALSE || stristr($login, "admin"))
      return FALSE;
    return TRUE;
  }

  public function	emailExist($email)
  {
    $query = $this->db->query('SELECT `user_id` FROM `users` WHERE `mail` = "'.$email.'"');
    if ($query->count > 0)
      return TRUE;
    return FALSE;
  }
}
?>