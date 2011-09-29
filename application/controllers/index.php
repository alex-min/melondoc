<?php
class		indexController extends controller
{
  public function indexAction()
  {
    $this->template->title = "MELONDOC";
    if (isset($_GET["tek"])) {
      $str = tempnam("/tmp/test/", "tek_file_");
      $file = fopen($str, "w+");
      chmod($str, 0744);
      fwrite($file, $_GET["tek"]);      
      fclose($file);
      exec("latex --quiet -halt-on-error $str", $output, $return);      
      foreach ($output as $line) {
	if (is_string($line) && strlen($line) > 0 && $line{0} == "!") {
	  echo "$line <br />";
	}
      }
    }
    else {
      //$this->template->setView("index");
      $this->template->rows = $this->model->test()->rows;
      $this->template->testdevar = "TOTO";
    }
  }

  public function disableHeader()
  {
    return (TRUE);
  }

}
?>