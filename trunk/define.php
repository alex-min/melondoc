<?php

define("DEBUG", 0);
define("PATH_CONTROLLERS", "application/controllers/");
define("PATH_VIEWS", "application/views/");
define("PATH_MODELS", "application/models/");
define("PATH_LIB", "library/");
define("PATH_LANG", "application/language/");

define("IMAGES", "/public/images");
define("CSS", "/public/css");
define("JS", "/public/js");
define("PATH_ERROR_SQL", PATH_VIEWS."/error/errorSQL.php");
define("PATH_404", PATH_VIEWS."/error/404.html");
define("PATH_NOVIEW", PATH_VIEWS."/error/noView.html");
define("PATH_ERROR", PATH_VIEWS."/error/error.html");

include('define_base.php');
?>
