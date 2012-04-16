<?php

class getdocController extends controller
{
  public function indexAction()
  {
  	$var = $this->model->retreiveDoc($_GET['id']);
  	echo json_encode($var);
  	exit;
  }

  public function disableHeader()
  { return (TRUE); }
}