<?php

class indexController extends controller
{
  public function indexAction()
  {
    $this->addCSS("dialog");
    $this->addCss("header");
    $this->addJavascript("header");
    $this->template->setView("header");
    
    $this->template->loadLanguage("index");
    $this->template->setView("index");
  }
}
?>
