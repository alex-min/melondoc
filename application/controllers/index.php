<?php
class		indexController extends controller
{
  public function indexAction()
  {
    $this->template->titre = "MELONDOC";
    $this->template->setView("index");
    $this->template->testdevar = "TOTO";
  }
}
?>