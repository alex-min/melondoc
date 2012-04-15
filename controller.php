<?php

class				controller
{
  protected			$class;

  protected			$model;
  protected			$db;
  protected			$root;

  private      		$module;
  private      		$action;
  private	       	$models;
  private      		$controller;

  protected			$GET;
  protected			$POST ;
  protected			$FILES;
  
  protected			$needLogin	= 0;
  private      		$jsArray	= "";
  private      		$cssArray	= "";

  /**
   * @fn function __get($key)
   * @brief 
   * @file controller.php
   * 
   * @param key         
   * @return		
   */
  public function		__get($key) {return (isset($this->class[$key])) ? $this->class[$key] : NULL;}


  /**
   * @fn function init(&$rooter, &$objet)
   * @brief 
   * @file controller.php
   * 
   * @param rooter              
   * @param objet               
   * @return		
   */
  public function		init(&$rooter, &$objet)
  {
    require_once("./".PATH_LIB."twig/lib/Twig/Autoloader.php");
    Twig_Autoloader::register();
    $dont = array("rooter" => 0, "error" => 0);
    include_once("model.php");
    $this->root = $rooter;
    $this->class['root'] = $rooter;
    $array = glob("./".PATH_LIB."*.php");
    foreach ($array AS $value)
      {
	$temp = str_replace(".php", "", str_replace("./".PATH_LIB, "", $value));
	if (array_key_exists($temp, $dont) === FALSE)
	  $this->loadLibrary($temp);
      }
    foreach ($this->class AS $obj)
      if (method_exists($obj, "loadLib"))
	$obj->loadLib($this->class);
    $this->start($objet);
  }

  /**
   * @fn function init_variables()
   * @brief 
   * @file controller.php
   * 
   * @param             
   * @return		
   */
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

  /**
   * @fn function start($objet)
   * @brief 
   * @file controller.php
   * 
   * @param objet               
   * @return		
   */
  private function		start($objet)
  {
    $this->KLogger->logInfo("--------------[START SCRIPT]------------------");
    if (method_exists($objet, 'disableHeader') && $objet->disableHeader() == TRUE) {
      $this->KLogger->logInfo("[call] call to light controller");
      $disableHeader = TRUE;
    } else {
      $disableHeader = FALSE;
      $this->template->loadLanguage("header");
      $this->addJavascript("jquery-1.7.min");
      $this->addJavascript("dialog");
      $this->addJavascript("framework");
      $this->addJavascript("config");
      $this->addJavascript("jqueryFileTree");
      $this->addJavascript("header");
      $this->addCSS("dialog");
      if (BOOTSTRAP){
	$this->addJavascript("less-1.2.1.min");
	$this->addJavascript(PATH_BOOTSTRAP_JS."bootstrap");
	$this->cssArray .= "<link rel=\"stylesheet/less\" href=\"/public/less/bootstrap.less\" />\n";
      }
      $this->addCSS("style", "design");
    }
    $this->init_variables();
    $this->model = $this->loadModel($this->models, $this->module);
    $this->initAction($objet);
    $this->template->jsArray = $this->jsArray;
    $this->template->cssArray = $this->cssArray;
    $this->template->isLogged = $this->user->isLogged();
    $this->template->COUNTDOWN = COUNTDOWN;
    $this->template->isAdmin = $this->user->isAdmin();
    if ($this->root->isAjax() == FALSE)
      {
      	$this->template->fetch($this->module, $disableHeader);
      	$this->template->display();
      }
    else if ($this->root->isAjax() == TRUE)
      $this->template->fetchAjax($this->module);
    $this->KLogger->logInfo("--------------[END SCRIPT]------------------");
  }

  /**
   * @fn function initAction($objet)
   * @brief 
   * @file controller.php
   * 
   * @param objet               
   * @return		
   */
  private function		initAction($objet)
  {
    $pageController = $objet;
    if (COUNTDOWN && $this->root->getcontroller() != "countdown")
      {
	$this->template->redirect("", TRUE, "/countdown/");
	return ;
      }
    if (!method_exists($pageController, $this->action))
      {
      	if ($this->root->isAjax() == TRUE)
	  		exit();
      	$this->template->redirect("", FALSE, "/".str_replace("Controller", "", $this->controller));
      }
    $pageAction = $this->action;
    $pageController->$pageAction();
  }

  /**
   * @fn function loadClass($var)
   * @brief 
   * @file controller.php
   * 
   * @param var         
   * @return		
   */
  private function		loadClass($var)
  {
    if (class_exists($var))
      {
	$test = new $var($this->class);
	if ($test)
	  $this->class[$var] = $test;
      }
  }
  /**
   * @fn function loadLibrary($var)
   * @brief 
   * @file controller.php
   * 
   * @param var         
   * @return		
   */
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

  /**
   * @fn function loadModel($var, $module = "")
   * @brief 
   * @file controller.php
   * 
   * @param var         
   * @param module              
   * @return		
   */
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

  /**
   * @fn function addJavascript($url)
   * @brief 
   * @file controller.php
   * 
   * @param url         
   * @return		
   */
  public function		addJavascript($url)
  {
    $this->jsArray .= "<script type=\"text/javascript\" src=\"".JS."/".$url.".js\"></script>\n";
    if ($this->KLogger)
      $this->KLogger->logInfo("[Js] : ".$url);
  }
  
  /**
   * @fn function addCSS($url, $title = "Css")
   * @brief 
   * @file controller.php
   * 
   * @param url         
   * @param title               
   * @return		
   */
  public function		addCSS($url, $title = "design") 
  {
    $this->cssArray .= "<link rel=\"stylesheet\" media=\"screen\" type=\"text/css\" title=\"".$title."\" href=\"".CSS."/".$url.".css\" />\n";
    if ($this->KLogger)
      $this->KLogger->logInfo("[Css] : ".$url);
  }

}
?>
