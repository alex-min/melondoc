<?php
class		template
{
  private	$data = array();
  private	$flux;
  private	$vue = array();
  private	$json = array();
  public	$language;
  public	$KLogger;
  
  public function __construct($class)
  {
    $this->KLogger = $class['KLogger'];
    if (isset($_SESSION['error']) && $_SESSION['error'])
      {
	$this->__set("__error", $_SESSION['error']);
	$this->KLogger->logInfo("[error] ".$_SESSION['error']);
      }
    if (isset($_SESSION['success']) && $_SESSION['success'])
      {
	$this->__set("__success", $_SESSION['success']);
	$this->KLogger->logInfo("[success] ".$_SESSION['success']);
      }
    unset($_SESSION['error']);
    unset($_SESSION['success']);
  }

  public function redirect($msg, $isError, $url = "SELF")
  {
    if ($isError == TRUE)
      $this->setError($msg);
    else
      $this->setSuccess($msg);
    if ($url == "SELF")
      $url = str_replace("?".$_SERVER['QUERY_STRING'], "", $_SERVER['REQUEST_URI']);
    $this->KLogger->logInfo("[Redirect] ".$url);
    header("Location: ".$url);
    exit();
  }

  private function setError($str) {$_SESSION['error'] = $str;}
  private function setSuccess($str) {$_SESSION['success'] = $str;}
  public function __get($key) {return isset($this->data[$key]) ? $this->data[$key] : NULL;}
  public function __set($key, $value) {$this->data[$key] = $value;}

  public function fetch($module = "")
  {
    ob_start();
    $this->loadView($module);
    $this->flux = ob_get_contents();
    ob_end_clean();
  }

  public function addJSON($array)
  {
    if (is_array($array))
      $this->json = array_merge($this->json, $array);
  }

  public function fetchAjax($module = "")
  {
    ob_start();
    if ($this->countView() > 0)
      {
	$this->loadView($module);
	$this->json['_html_'] = ob_get_contents();
      }
    $this->KLogger->logDebug($this->json);
    ob_end_clean();
    echo json_encode($this->json);
    exit;
  }

  public function display() {echo $this->flux;}
  public function has($key) {return isset($this->data[$key]);}
  public function getData() {return $this->data;}

  public function setView($var) {$this->vue[$var] = $var;}
  public function countView() {
    $i = 0;
    foreach ($this->vue AS $views)
      if (file_exists($url))
	$i++;
    return $i;
  }

  public function loadView($module, $ajax = false)
  {
    extract($this->data);
    if ($ajax == false)
      include('application/views/HeaderView.tpl');
    foreach ($this->vue AS $views)
      {
	$url = PATH_VIEWS.$module.''.$views.".tpl";
	if (file_exists($url))
	  {
	    include_once($url);
	    $this->KLogger->logInfo("[View] ".$views);
	  }
	else
	  $this->KLogger->logFatal("[View] ".$views);
      }
    if ($ajax == false)
      include('application/views/FooterView.tpl');
  }

  public function       	loadLanguage($lang, $controller)
  {
    $url = PATH_LANG.LANG."/".$controller.".php";
    if (!file_exists($url))
      {
	$this->KLogger->logFatal("[Language] ".$controller);
	return;
      }
    else
      $this->KLogger->logInfo("[Language] ".$controller);
    require_once($url);
    if (isset($_) && !is_array($_))
      $_ = array();
    if (is_array($this->language))
      $this->language = array_merge($this->language, $_);
    else
      {
	$this->language = $_;
	$this->data['_lang'] = &$this->language;
      }
    unset($_);
    unset($url);
    unset($controller);
  }
}
?>