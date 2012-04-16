<?php
class	editor2Model extends Model
{
  public function getNameDoc($id)
  {
    $query = $this->db->query('SELECT `nom` FROM `documents` WHERE `id_document` = "'.$id.'"');
    if ($query->count > 0)
      return $query->row['nom'];
    return "new document";
  }

  public function modifyNameDoc($name, $doc_id)
  {
    $name = mysql_real_escape_string($name);
    $this->db->query('UPDATE `documents` SET `nom` = "'.$name.'" WHERE `id_document` = "'.$doc_id.'"');
  }
}
?>