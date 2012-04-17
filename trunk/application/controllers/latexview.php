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
      $this->template->title = 'the unknown world';
    }
    else {
      $tek = ($_POST["tek"]);
      $str = str_replace("/tmp/", "", $this->createTekFile($tek));
      $this->addJavascript("latexview");
      $this->addCss("latexview");
      $this->addCss("error");
      $this->template->latexContent = htmlentities($str);
      $this->template->setView("latexview");
    }
  }

  public function disableHeader()
  { return (TRUE); }

}

?>