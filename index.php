<?php

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
