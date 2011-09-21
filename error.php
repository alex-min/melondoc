<?php

class errorMVC
{
  public static function error404()
  {
    include(PATH_404);
    exit();
  }

  public static function error()
  {
    include(PATH_ERROR);
    exit();
  }

  public static function noView()
  {
    include(PATH_NOVIEW);
    exit();
  }
  
  public static function errorSQL($sql)
  {
    $err = (DEBUG == 1) ? 'Error: ' . mysql_error() . '<br />Error No: ' . mysql_errno() . '<br />' . $sql : NULL;
    include(PATH_ERROR_SQL);
    exit();
  }
}
?>