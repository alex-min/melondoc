<?php
   class indexModel extends model
   {
     public function test()
     {
       $this->db->getLastId();
       $res = $this->db->query("select * from miam");
       return ($res);
     }
   }
?>