<?php

class latexviewController extends controller
{
  public function createTekFile($content)
  {
      $str = tempnam("/tmp", "tek_file_");
      $file = fopen($str, "w+");
      chmod($str, 0744);
      fputs($file, $content);
      fclose($file);    
      return ($str);
  }

  public function indexAction()
  {
    if (!isset($_POST["tek"])) {
      $this->template->setView("postlatex");
    }
    else {
      $str = str_replace("/tmp/", "", $this->createTekFile($_POST["tek"]));
      $this->addJavascript("latexview");
      $this->addCss("latexview");
      $this->addCss("error");
      $this->template->latexContent = htmlentities($str);
      $this->template->setView("latexview");
    }
  }

}

?>