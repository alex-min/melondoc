<?php
class		template
{
  private	$data = array();
  private	$flux;
  private	$vue;
  public	$language;
  
  public function __construct()
  {
    if (isset($_SESSION['error']) && $_SESSION['error'])
      $this->__set("__error", $_SESSION['error']);
    if (isset($_SESSION['success']) && $_SESSION['success'])
      $this->__set("__success", $_SESSION['success']);
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
    controller::redirect($url);
    exit();
  }

  private function setError($str) {$_SESSION['error'] = $str;}
  private function setSuccess($str) {$_SESSION['success'] = $str;}
  public function __get($key) {return isset($this->data[$key]) ? $this->data[$key] : NULL;}
  public function __set($key, $value) {$this->data[$key] = $value;}

  public function fetch($module = "")
  {
    ob_start();
    $this->loadView($this->vue, $module);
    $this->flux = ob_get_contents();
    ob_end_clean();
  }

  public function display() {echo $this->flux;}
  public function has($key) {return isset($this->data[$key]);}
  public function getData() {return $this->data;}
  public function setView($var) {$this->vue = $var;}

  public function loadView($var, $module = "")
  {
    extract($this->data);
    include('application/views/HeaderView.php');
    $url = PATH_VIEWS.$module.''.$var.".php";
    if (file_exists($url))
      include_once($url);
    include('application/views/FooterView.php');
  }

  public function       	loadLanguage($lang, $controller)
  {
    $url = PATH_LANG.LANG."/".$controller.".php";
    if (!file_exists($url))
      {
	echo "Can't load language file : ".$controller;
	return;
      }
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