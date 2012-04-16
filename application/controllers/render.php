<?php

class		renderController extends controller
{
  public function indexAction()
  {
    $this->template->title = "MELONDOC";
    if (isset($_POST["tek"])) {
      $str = $_POST["tek"];      
      exec("cd /tmp && latex --quiet -halt-on-error -output-directory '/tmp' $str", $output, $return);
      $this->template->result = $return;
      $return = 0;
      $errorList = array();
      $i = 0;
      foreach ($output as $line) {
	if (is_string($line) && strlen($line) > 0 && $line{0} == "!") {
	  $errorList[$i++] = $line;
	}
      }
      if ($return == 0) {

	$str = str_replace("/tmp/", "", $str);
	exec("dvipng -T '17cm,29cm' -q /tmp/$str.dvi -o " . RENDER_DIR . "$str-%d.png", $output, $return);
	if ($return != 0) {
	  $this->template->result = $return;
	  $this->template->errorList = array("Convert to png error occured");
	}
	$renderImages = glob(RENDER_DIR . "$str*.png");
	$this->template->renderImages = $renderImages;
      }
      $this->template->errorList = $errorList;
      $this->template->setView("render");
    }
    else {
      //$this->template->setView("index");
      echo 'this file cannot be called alone.';
    }
  }

  public function disableHeader()
  { return (TRUE); }

}
?>