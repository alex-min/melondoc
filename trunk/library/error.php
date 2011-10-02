<?php
class error
{
  /**
   * @fn function fetchError($title, $title_h1, $text_erreur, $query = "")
   * @brief 
   * @file error.php
   * 
   * @param title               
   * @param title_h1            
   * @param text_erreur         
   * @param query       	
   * @return		
   */
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

  /**
   * @fn function ErrorSQL($query)
   * @brief 
   * @file error.php
   * 
   * @param query               
   * @return		
   */
  public static function ErrorSQL($query)
  {
    if (DEBUG) {
      self::fetchError("Erreur SQL", "Erreur SQL", "Une requête SQL a échouée : <br />"
		       . mysql_error());
    } else {
      self::fetchError("Erreur SQL", "Erreur SQL", "Une requête SQL a échouée");
    }
  }
  
  /**
   * @fn function ErrorController()
   * @brief 
   * @file error.php
   * 
   * @param             
   * @return		
   */
  public static function ErrorController()
  {
    self::fetchError("Erreur 404", "Erreur 404", "Cette page n'existe pas");
  }
}
?>