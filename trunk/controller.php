<?php

class				controller
{
  protected			$class;

  protected			$model;
  protected			$db;
  protected			$root;

  private      			$module;
  private      			$action;
  private	       		$models;
  private      			$controller;
  
  protected			$GET;
  protected			$POST ;
  protected			$FILES;
  
  protected			$needLogin	= 0;
  private      			$jsArray	= "";
  private      			$cssArray	= "";

  public function		__get($key) {return (isset($this->class[$key])) ? $this->class[$key] : NULL;}

  public function		init(&$rooter, &$objet)
  {
    include_once("model.php");    
    $this->root = $rooter;
    $array = glob("./library/*.php");
    foreach ($array AS $value)
      {
	$temp = str_replace(".php", "", str_replace("./library/", "", $value));
	$this->loadLibrary($temp);
     }
    $this->start($objet);
  }

  private function		init_variables()
  {
    // URL
    $this->controller = $this->root->getController();
    $this->action = $this->root->getAction();
    $this->models = $this->root->getModel();
    $this->module = $this->root->getModule();

    // SUPERGLOBALES
    $this->GET = $this->root->getGET();
    $this->POST = $this->root->getPOST();
    $this->FILES = $this->root->getFILES();
  }

  private function		start($objet)
  {
    $this->addCSS("header.css", "design");
    $this->init_variables();
    $this->model = $this->loadModel($this->models, $this->module);
    $this->initAction($objet);
    $this->template->jsArray = $this->jsArray;
    $this->template->cssArray = $this->cssArray;
    if ($this->root->isAjax() == FALSE)
      {
      	$this->template->fetch($this->vue, $this->module);
      	$this->template->display();
      }
  }

  private function		initAction($objet)
  {
    $pageController = $objet;
    if (!method_exists($pageController, $this->action))
      {
      	if ($this->root->isAjax() == TRUE)
      		exit();
      	self::redirect("/".str_replace("Controller", "", $this->controller));
	  }
    $pageAction = $this->action;
    $pageController->$pageAction();
  }

  private function		loadClass($var)
  {
    $test = new $var($this->class);
    if ($test)
      $this->class[$var] = $test;
  }

  public function		loadLibrary($var)
  {
    $url = PATH_LIB.$var.".php";
    if (!file_exists($url))
      {
	echo "Can't load library : ".$var;
	return ;
      }
    include_once($url);
    $this->loadClass($var);
  }

  public function		loadModel($var, $module = "")
  {
    $url = PATH_MODELS.$module.''.$var.".php";
    if (!file_exists($url)) {return ;}
    include_once($url);
    $this->loadClass($var."Model");
    return $this->class[$var."Model"];
  }

  public static function	sendMail($message, $email, $objet)
  {
    $headers = 'From: "Test"<contact@test.fr>'."\n";
    $headers .= 'Reply-To: contact@test.fr'."\n";
    $headers .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n";
    $headers .= 'Content-Transfer-Encoding: 8bit';
    mail($email, $objet, $message, $headers);
  }
  
  public static function	redirect($url) {header("Location: ".$url);}
  public function		addJavascript($url) {$this->jsArray .= "<script type=\"text/javascript\" src=\"".JS."/".$url.".js\"></script>\n";}

  public function		addCSS($url, $title = "Css") {$this->cssArray .= "<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" title=\"".$title."\" href=\"".CSS."/".$url.".css\" />\n";}

  public static function	json_send_array($array)
  {
    echo json_encode($array);
    return ;
  }
}
?>
