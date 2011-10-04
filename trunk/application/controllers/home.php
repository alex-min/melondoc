<?php
class			homeController extends controller
{
  public function	indexAction() // ici c'est l'home du mec
  {
    $this->user->needLogin();
  }

  public function	pagesAction() // ici c'est la page de quelqu'un d'autre
  {
    $this->user->needLogin();
    $user_id = intval($this->GET['id']);
  }

}
?>