<?php

class indexController extends controller
{
  public function indexAction()
  {
    $this->template->setView("header");    
    $this->template->loadLanguage("index");
    $this->template->setView("index");
    $this->template->toto = "tata";
  }
}
?>
