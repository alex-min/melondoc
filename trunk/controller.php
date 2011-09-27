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
    $dont = array("rooter" => 0, "error" => 0, "image" => 0);
    include_once("model.php");
    $this->root = $rooter;
    $array = glob("./".PATH_LIB."*.php");
    foreach ($array AS $value)
      {
	$temp = str_replace(".php", "", str_replace("./".PATH_LIB, "", $value));
	if (array_key_exists($temp, $dont) === FALSE)
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
    $this->KLogger->logInfo("--------------[START SCRIPT]------------------");
    $this->addCSS("header", "design");
    $this->addJavascript("jquery.1.6.4.min");
    $this->addJavascript("config");
    $this->addJavascript("framework");
    $this->init_variables();
    $this->model = $this->loadModel($this->models, $this->module);
    $this->initAction($objet);
    $this->template->jsArray = $this->jsArray;
    $this->template->cssArray = $this->cssArray;
    if ($this->root->isAjax() == FALSE)
      {
      	$this->template->fetch($this->module);
      	$this->template->display();
      }
    else if ($this->root->isAjax() == TRUE)
      $this->template->fetchAjax($this->module);
    $this->KLogger->logInfo("--------------[END SCRIPT]------------------");
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
	if ($this->KLogger)
	  $this->KLogger->logFatal("[Library] : ".$url);
	return ;
      }
    else
      if ($this->KLogger)
	$this->KLogger->logInfo("[Library] : ".$url);
    include_once($url);
    $this->loadClass($var);
  }

  public function		loadModel($var, $module = "")
  {
    $url = PATH_MODELS.$module.''.$var.".php";
    if (!file_exists($url)) 
      {
	if ($this->KLogger)
	  $this->KLogger->logFatal("[Model] : ".$var);
	return ;
      }
    else
      if ($this->KLogger)
	$this->KLogger->logInfo("[Model] : ".$var);
    include_once($url);
    $var .= "Model";
    $this->loadClass($var);
    return $this->class[$var];
  }

  public function		addJavascript($url)
  {
    $this->jsArray .= "<script type=\"text/javascript\" src=\"".JS."/".$url.".js\"></script>\n";
    if ($this->KLogger)
      $this->KLogger->logInfo("[Js] : ".$url);
  }
  
  public function		addCSS($url, $title = "Css") 
  {
    $this->cssArray .= "<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" title=\"".$title."\" href=\"".CSS."/".$url.".css\" />\n";
    if ($this->KLogger)
      $this->KLogger->logInfo("[Css] : ".$url);
  }

}
?>
