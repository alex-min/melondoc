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

  public function		categoriesAction()
  {
    $this->user->needLogin(1);
    $obj = $this->loadModel("home");
    $this->template->categories = $obj->getListCategorie();
    $this->template->setView("adminCategories");
  }

  public function		ModifyUsersAction()
  {
    $this->user->needLogin(1);
    $this->template->loadLanguage("admin");
    if (isset($_POST) && count($_POST) > 0)
      {
	$this->model->modifyUsers($_POST);
	$this->template->redirect($this->template->language['admin_modify_users_success'], TRUE, "/admin/users");
      }
    else if (!isset($_GET['id']))
      $this->template->redirect("", FALSE, "/admin/users");
    $this->template->user = $this->user->getUserFromID(intval($_GET['id']));
    $this->template->setView("adminModifyUsers");
  }

  public function		ModifyCategoriesAction()
  {
    $this->user->needLogin(1);
    $this->template->loadLanguage("admin");
    if (isset($_POST) && count($_POST) > 0)
      {
	$this->model->modifyCategories($_POST);
	$this->template->redirect($this->template->language['admin_modify_users_success'], TRUE, "/admin/categories");
      }
    else if (!isset($_GET['id']))
      $this->template->redirect("", FALSE, "/admin/users");
    $this->template->user = $this->user->getUserFromID(intval($_GET['id']));
    $this->template->setView("adminModifyUsers");
  }

  public function		DelUsersAction()
  {
    $this->user->needLogin(1);
    $id = intval($_GET['id']);
    $this->model->delUsers($id);
    $this->template->redirect("", FALSE, "/admin/users");
 }

  public function		DelCategoriesAction()
  {
    $this->user->needLogin(1);
    $id = intval($_GET['id']);
    $this->model->delCategories($id);
    $this->template->redirect("", FALSE, "/admin/categories");
 }
}
?>