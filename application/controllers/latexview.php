<?php

class latexviewController extends controller
{
  public function indexAction()
  {
    if (!isset($_POST["tek"])) {
      $this->template->setView("postlatex");
    }
    else {
      $this->addJavascript("latexview");
      $this->addCss("latexview");
      $this->addCss("error");
      $this->template->latexContent = htmlentities($_POST["tek"]);
      $this->template->setView("latexview");
    }
  }

}

?>