<?php
  /* Copyright © <2011> <singler> <julien>
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA<?php
  */
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