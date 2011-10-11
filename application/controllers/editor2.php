<?php

class Editor2Controller extends controller
{
  public function indexAction()
  {
   $this->addCss("editor2");
   $this->addJavascript("jquery-ui-1.8.16.custom.min");
   $this->template->setView("editor2");
  }	
}