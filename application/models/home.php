<?php
class		homeModel extends model
{
  public function  deleteDoc($doc_id)
  {
    $this->db->query('UPDATE `documents` SET `deleted` = "1" WHERE `id_document` = "'.$doc_id.'"');
  }

  public function	verifyTypeTemplate($id)
  {
    $query = $this->db->query('SELECT `template_id` FROM `templates` WHERE `template_id` = "'.$id.'" LIMIT 1');
    if ($query->count <= 0)
      return false;
    return true;
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
    return $this->db->getLastId();
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