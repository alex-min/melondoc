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
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
*/
if (!session_id()) {
  ini_set('session.use_cookies', 'On');
  ini_set('session.use_trans_sid', 'Off');  
  ini_set ('max_execution_time', 90);
  session_set_cookie_params(0, '/');
  session_start();
}

date_default_timezone_set('Europe/Berlin');
include('define.php');
include('error.php');
include('controller.php');
include(PATH_LIB.'rooter.php');
$rooter = new rooter();
$rooter->parseURI($_SERVER['REQUEST_URI']);
if ($rooter->isAjax() == FALSE)
  $rooter->checkErrorDispatch();

include(PATH_CONTROLLERS.$rooter->getModule().$rooter->getController().".php");
$class = $rooter->getController();
$control = new $class;
$control->init($rooter, $control);
exit();
?>
