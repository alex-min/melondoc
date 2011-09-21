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

class		rooter
{
  private	$controller = "";
  private	$action = "";
  private	$module = "";
  private	$model = "";
  private	$GET;
  private	$POST;
  private	$FILES;
  private	$Ajax = FALSE;

  public function __construct()
  {
    $this->GET = $this->clean($_GET);
    $this->POST = $this->clean($_POST);
    $this->FILES = $this->clean($_FILES);
  }

  public function clean($data)
  {
    if (is_array($data))
      foreach ($data as $key => $value)
	$data[self::clean($key)] = self::clean($value);
    else 
      $data = strisplashes(htmlspecialchars($data));
    return $data;
  }
  
  public function parseURI($requete)
  {
    $uri = substr($requete, 1); // on enleve le premier caractere c'est a dire le /
    $array = explode("/", $uri); // on explose l'uri a partir du caractere /
    $v = 0;// initialisation
    // si le tableau contenant les fragment d'uri contient plus de 2 elements 
    if (($i = count($array)) > 2)
      {
	while ($i > 2) // tant qu'il ne reste pas que le controller et l'action
	  {
	    $this->module .= $array[$v]; // on concatene le path en ajoutant les /
	    $this->module .= "/";
	    $i--;
	    $v++;
	  }
      }
    $this->controller = $array[$v++]; // on recupere le controller
    $this->Ajax = FALSE;
    if ($this->checkAjaxRequest() == TRUE)
      return ;
    $this->action = (isset($array[$v])) ? $array[$v] : NULL; // de meme pour l'action
    $pattern = "?".$_SERVER['QUERY_STRING'];
    $this->action = str_replace($pattern, "", $this->action); // on enleve les variables GET de l'action pour eviter d'avoir quelque chose comme toto?titi=tata
    if ($this->controller == NULL){$this->controller = "index";}
    if ($this->action == NULL){$this->action = "index";}
  }

  public function getFILES()		{return $this->FILES;}
  public function getGET()		{return $this->GET;}
  public function getPOST()		{return $this->POST;}
  public function getController()	{return ($this->Ajax) ? $this->controller : $this->controller;} // on applique le principe d'encapsulation ?!
  public function getAction()		{return ($this->Ajax) ? $this->action : $this->action."Action";}
  public function getModule()		{return $this->module;}
  public function getView()		{return $this->controller;}
  public function getModel()		{return $this->controller;}
  public function isAjax()		{return $this->Ajax;}

  private function checkAjaxRequest()
  {
    if ($this->controller == "ajax")
      {
	$this->Ajax = TRUE;
	$this->controller = $this->GET['controller'];
	$this->action = $this->GET['action'];
	$control = PATH_CONTROLLERS.$this->controller.".php";
	if (file_exists($control) == FALSE){exit();}
	return TRUE;
      }
    return FALSE;
  }

  public function checkErrorDispatch()
  {
    $view = PATH_VIEWS.$this->controller.".php";
    $model = PATH_MODELS.$this->controller.".php";
    $control = ($this->module) ? PATH_CONTROLLERS.$this->module.$this->controller.".php" : PATH_CONTROLLERS.$this->controller.".php";
    if (file_exists($control) == FALSE){errorMVC::error404(); exit();}
    return ;
  }
}
?>
