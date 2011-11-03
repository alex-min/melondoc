<?php
class		homeModel extends model
{
  public function	getListDocumentsFromUserID($user_id)
  {
    $query = $this->db->query('SELECT `path_template`, `nom`, `path_template` FROM `documents` WHERE `user_id` = "'.$user_id.'"');
	if ($query->count <= 0)
  		return FALSE;
	
	return $query->rows;
  }
}
?>