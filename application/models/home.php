<?php
class		homeModel extends model
{
  public function	getListDocumentsFromUserID($user_id)
  {
    $query = $this->db->query('SELECT * FROM `documents` WHERE `user_id` = "'.$user_id.'" AND `deleted` != "1"');
    if ($query->count <= 0)
      return FALSE;
    return $query->rows;
  }
  
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
}
?>