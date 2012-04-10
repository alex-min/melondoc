<?php
class     adminController extends controller
{
  public function		indexAction()
  {
    $this->user->needLogin(1);
    $this->template->setView("admin");
    
  }

  public function		usersAction()
  {
    $this->user->needLogin(1);
    $this->template->users = $this->model->getUsers();
    $this->template->setView("adminUsers");
  }

  public function		ModifyUsersAction()
  {
    $this->user->needLogin(1);
    if (isset($_POST))
      {
	$this->model->modifyUsers($_POST);
	$this->template->redirect("", TRUE, "/admin/users");
      }
    $this->template->setView("");
  }

  public function		DelUsersAction()
  {
    $this->user->needLogin(1);
    $id = intval($_GET['id']);
    $this->model->delUsers($id);
    $this->template->redirect("", FALSE, "/admin/users");
 }
}
?>