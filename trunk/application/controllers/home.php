<?php
class			homeController extends controller
{
  public function	indexAction() // ici c'est l'home du mec
  {
    $this->user->needLogin();
    $this->template->setView("header");
    $documents = $this->model->getListDocumentsFromUserID($_SESSION['user']['user_id']);
  }

  public function	pagesAction() // ici c'est la page de quelqu'un d'autre
  {
    $this->user->needLogin();
    $this->template->setView("header");
    $user_id = intval($this->GET['id']);
  }

}
?>