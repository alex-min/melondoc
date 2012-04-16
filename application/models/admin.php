<?php
class	adminModel extends Model
{
  public function		getUsers()
  {
    $query = $this->db->query('SELECT * FROM `users`');
    if ($query->count > 0)
      return $query->rows;
    return FALSE;
  }

  public function		delUsers($id)
  {
    $this->db->query('DELETE * FROM `users` WHERE `user_id` = "'.$id.'"');
  }

  public function		delCategories($id)
  {
    $this->db->query('DELETE * FROM `categories` WHERE `id_category` = "'.$id.'"');
  }

  public function		addCategories($array)
  {
    $this->db->query('INSERT INTO `categories` SET `name` = "'.$array['name'].'", `description` = "'.$array['description'].'", `avatar` = "'.$array['avatar'].'"');
  }

  public function		modifyCategories($array)
  {
    $this->db->query('UPDATE `categories` SET `name` = "'.$array['name'].'", `description` = "'.$array['description'].'", `avatar` = "'.$array['avatar'].'" WHERE `id_category` = "'.$array['id_category'].'"');
  }

  public function		modifyUsers($array)
  {
    $sql = 'UPDATE `users` SET login = "'.$array['form_login'].'", firstname = "'.$array['form_firstname'].'", lastname = "'.$array['form_lastname'].'", mail = "'.$array['form_email'].'"';
    if (strlen($array['form_mdp']) > 0)
      $sql .= ', password = "'.md5(SALT.$array['form_mdp']).'"';
    $sql .= ' WHERE `user_id` = "'.$array['user_id'].'"';
    $this->db->query($sql);
  }
}
?>