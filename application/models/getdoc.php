<?php
class		getdocModel extends model
{
  public function  retreiveDoc($doc_id)
  {
    $query = $this->db->query('SELECT `content` from `documents` where `id_document` = ' . intval($doc_id));
    if ($query->count > 0)
      return $query->rows;
  	return 0;
  }
}

?>