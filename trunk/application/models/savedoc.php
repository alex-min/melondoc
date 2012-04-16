<?php
   class savedocModel extends model
   {
     public function save($doc,$id)
     {
        $query = $this->db->query("UPDATE `documents` set content = '" . mysql_real_escape_string($doc) . 
          "' WHERE id_document=" . intval($id) . ';');
       return ($res);
     }
   }
?>