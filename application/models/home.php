<?php
class		homeModel extends model
{
  public function  deleteDoc($doc_id)
  {
    $this->db->query('UPDATE `documents` SET `deleted` = "1" WHERE `id_document` = "'.$doc_id.'"');
  }

  public function	getUsersCompletion($letter)
  {
    $query = $this->db->query('SELECT `user_id`, `login`, firstname, lastname FROM `users` WHERE `login` LIKE "%'.$letter.'%" OR `firstname` LIKE "%'.$letter.'%" OR `lastname` LIKE "%'.$letter.'%"');
    if ($query->count > 0)
      return $query->rows;
    return FALSE;
  }

  public function	getGroupsCompletion($letter)
  {
    $query = $this->db->query('SELECT * FROM `groups` WHERE `group_name` LIKE "%'.$letter.'%"');
    if ($query->count > 0)
      return $query->rows;
    return FALSE;
  }

  public function	verifyTypeTemplate($id)
  {
    $query = $this->db->query('SELECT `template_id` FROM `templates` WHERE `template_id` = "'.$id.'" LIMIT 1');
    if ($query->count <= 0)
      return false;
    return true;
  }

  public function	getRightsFromDocID($doc_id)
  {
    $query = $this->db->query('SELECT ur.*, u.`login` FROM `users_rights` ur LEFT JOIN `users` u ON (u.`user_id` = ur.`user_id`) WHERE ur.`document_id` = "'.$doc_id.'"');
    if ($query->count > 0)
      return $query->rows;
    return FALSE;
  }

  public function	getRightDocUser($doc_id, $user_id)
  {
    $query = $this->db->query('SELECT `user_right` FROM `users_rights` WHERE `document_id` = "'.$doc_id.'" AND `user_id` = "'.$user_id.'"');
    if ($query->count > 0)
      return $query->row['user_right'];
    return FALSE;
  }

  public function	getRightsDocGroup($doc_id, $group_id)
  {
    $query = $this->db->query('SELECT `group_rights` FROM `groups_rights` WHERE `id_document` = "'.$doc_id.'" AND `id_group` = "'.$group_id.'"');
    if ($query->count > 0)
      return $query->row['group_rights'];
    return FALSE;
  }

  public function	addUserRights($doc_id, $user_id, $right)
  {
    if ($this->getRightDocUser($doc_id, $user_id) === FALSE)
      $this->db->query('INSERT INTO `users_rights` SET `user_id` = "'.$user_id.'", `user_right` = "'.$right.'", `document_id` = "'.$doc_id.'"');
    else
      $this->changeRightUser($doc_id, $user_id, $right);
  }

  public function	addGroupRights($doc_id, $group_id, $right)
  {
    if ($this->getRightsDocGroup($doc_id, $group_id) === FALSE)
      $this->db->query('INSERT INTO `groups_rights` SET `group_rights` = "'.$right.'", `id_group` = "'.$group_id.'", `id_document` = "'.$doc_id.'"');
    else
      $this->changeRightGroup($doc_id, $group_id, $right);
  }

  public function	getGRightsFromDocID($doc_id)
  {
    $query = $this->db->query('SELECT g.`group_name`, g.`id_group`, gr.`group_rights` FROM groups g LEFT JOIN `groups_rights` gr ON (g.`id_group` = gr.`id_group`) WHERE gr.`id_document` = "'.$doc_id.'"');
    if ($query->count > 0)
      return $query->rows;
    return FALSE;
  }
  
  public function	delRights($doc_id, $user_id)
  {
    $this->db->query('DELETE FROM `users_rights` WHERE `document_id` = "'.$doc_id.'" AND `user_id` = "'.$user_id.'"');
  }

  public function	delGroupRights($doc_id, $group_id)
  {
    $this->db->query('DELETE FROM `groups_rights` WHERE `id_group` = "'.$group_id.'" AND `id_document` = "'.$doc_id.'"');
  }

  public function	changeRightGroup($doc_id, $group_id, $right)
  {
    $this->db->query('UPDATE `groups_rights` SET `group_rights` = "'.$right.'" WHERE `id_group` = "'.$group_id.'" AND `id_document` = "'.$doc_id.'"');
  }
  public function	changeRightUser($doc_id, $user_id, $right)
  {
    $this->db->query('UPDATE `users_rights` SET `user_right` = "'.$right.'" WHERE `user_id` = "'.$user_id.'" AND `document_id` = "'.$doc_id.'"');
  }

  public function	getDocumentsFromUserIDAndCategorie($user_id, $categorie_id)
  {
    $query = $this->db->query('SELECT d.*, t.*, c.* FROM `documents` d LEFT JOIN `templates` t ON (d.`template_id` = t.`template_id`) LEFT JOIN `categories` c ON (t.`categorie_id` = c.`id_category`) WHERE d.`user_id` = "'.$user_id.'" AND d.`deleted` = 0 AND t.`categorie_id` = "'.$categorie_id.'"');
    if ($query->count > 0)
      return $query->rows;
    return FALSE;
  }

  public function	getDocumentsFromUserID($user_id)
  {
    $query = $this->db->query('SELECT d.*, t.*, c.* FROM `documents` d LEFT JOIN `templates` t ON (d.`template_id` = t.`template_id`) LEFT JOIN `categories` c ON (t.`categorie_id` = c.`id_category`) WHERE d.`user_id` = "'.$user_id.'" AND d.`deleted` = 0');
    if ($query->count > 0)
      return $query->rows;
    return FALSE;
  }

  public function	verifyTypeCategorie($id)
  {
    $query = $this->db->query('SELECT `id_category` FROM `categories` WHERE `id_category` = "'.$id.'" LIMIT 1');
    if ($query->count <= 0)
      return false;
    return true;
  }

  public function	addDocument($template_id, $user_id, $name)
  {
    $this->db->query('INSERT INTO `documents` SET `nom` = "'.$name.'", `user_id` = "'.$user_id.'", `template_id` = "'.$template_id.'"');
    $id = $this->db->getLastId();
    $this->db->query('INSERT INTO `users_rights` SET `user_right` = "owner", `user_id` = "'.$user_id.'", `document_id` = "'.$id.'"');
    return $id;
  }

  public function	getListTemplate()
  {
    $query = $this->db->query('SELECT * FROM `templates`');
    if ($query->count <= 0)
      return FALSE;
    return $query->rows;
  }

  public function	getListCategorie()
  {
    $query = $this->db->query('SELECT * FROM `categories`');
    if ($query->count <= 0)
      return FALSE;
    return $query->rows;
  }

}
?>