<?php
class			homeController extends controller
{
  public function	indexAction() // ici c'est l'home du mec
  {
    $this->user->needLogin();
    $this->template->setView("header");
	$id = $_SESSION['user']['user_id']; 
    if (isset($_GET['id']))
		$id = intval($_GET['id']);
    $documents = $this->model->getListDocumentsFromUserID($_SESSION['user']['user_id']);
  }
}
?>