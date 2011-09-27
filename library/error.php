<?php
class error
{
  public static function fetchError($title, $title_h1, $text_erreur, $query = "")
  {
    $text_ret = "Retourner à l'accueil";
    $link_css = CSS."/error.css";
    ob_start();
    include("application/views/_error.tpl");
    $flux = ob_get_contents();
    ob_end_clean();
    echo $flux;
    exit();
  }

  public static function ErrorSQL($query)
  {
    if (DEBUG) {
      self::fetchError("Erreur SQL", "Erreur SQL", "Une requête SQL a échouée : <br />"
		       . mysql_error());
    } else {
      self::fetchError("Erreur SQL", "Erreur SQL", "Une requête SQL a échouée");
    }
  }
  
  public static function ErrorController()
  {
    self::fetchError("Erreur 404", "Erreur 404", "Cette page n'existe pas");
  }
}
?>