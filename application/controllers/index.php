<?php

class indexController extends controller
{
  public function indexAction()
  {
  	$this->addJavascript("video");
  	$this->addCSS("video-js");
    $this->template->loadLanguage("index");
    $this->template->setView("index");
  }
}
?>
