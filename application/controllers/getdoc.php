<?php

class getdocController extends controller
{
  public function indexAction()
  {
  	$var = $this->model->retreiveDoc($this->GET['id']);
  	echo json_encode($var);
  }

  public function disableHeader()
  { return (TRUE); }
}