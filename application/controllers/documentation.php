<?php

class documentationController extends controller
{
  public function indexAction()
  {
  	$this->template->redirect("", FALSE, "/home/index");
  }

  public function easyJqueryAction()
  {
  	$this->addCss('documentation/style');
  	$this->addCss('documentation/highlight');

  	$this->addJavascript('documentation/pagescroller.min');
  	$this->addJavascript('documentation/highlight');
  	
    $this->template->setView('easyJquery');
  }
}
?>
