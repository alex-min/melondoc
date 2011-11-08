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
  	$this->db->query('UPDATE `documents` SET `deleted` = "1" WHERE `id_document` = "'.$ids.'"');
  }
}
?>