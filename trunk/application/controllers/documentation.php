<?php

class documentationController extends controller
{
  public function indexAction()
  {
    $this->template->redirect("", FALSE, "/documentation/easyJquery");
  }

  public function easyJqueryAction()
  {
    $this->addCss('documentation/style');
    $this->addCss('documentation/highlight');
    
    $this->addJavascript('documentation/pagescroller.min');
    $this->addJavascript('documentation/highlight');
	
    $this->template->setView('easyJquery');
  }

  public function singleFrameworkAction()
  {
    $this->addCss('documentation/style');
    $this->addCss('documentation/highlight');
    $this->addJavascript('documentation/pagescroller.min');
    $this->addJavascript('documentation/highlight');

    $this->template->setView('singleFramework');
    $this->template->maVariable = "{{maVariable}}";
    $this->template->maVariableLang = "{{_lang.variable_test}}";
  }
}
?>
