<?php

class EditorController extends controller
{
  public function indexAction()
  {
    $this->addCss("editor");
    $this->addJavascript("editor");
    $this->template->setView("editor");
  }
  public function disableHeader()
  {

  }
}