<?php
define("DEBUG", 0);
define("PATH_CONTROLLERS", "application/controllers/");
define("PATH_VIEWS", "application/views/");
define("PATH_MODELS", "application/models/");
define("PATH_LIB", "library/");
define("RENDER_DIR", "render/");
define("PATH_LANG", "application/language/");

// Utilisation du bootstrap de twitter
define("BOOTSTRAP", 1);
define("PATH_BOOTSTRAP_CSS", "bootstrap/");
define("PATH_BOOTSTRAP_JS", "bootstrap/");

// Paths pour les ressources
define("IMAGES", "/public/images");
define("CSS", "/public/css");
define("JS", "/public/js");

// Salt pour le 
define("SALT", "fdjs;has;jadg");
define("FB_APPID", "143510702441117");
define("FB_SECRET_KEY", "40f2260249c5a9fcf3dbc797333399a4");
define("COUNTDOWN", 0);
// Include des define pour la bdd
include('define_base.php');
?>
