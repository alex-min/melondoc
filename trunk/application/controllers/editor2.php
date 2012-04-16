<?php

class editor2Controller extends controller
{
  public function indexAction()
  {
    $this->user->needLogin();
    $id_doc = FALSE;
    if (isset($_GET['id']))
      $id_doc = (intval($_GET['id']) > 0) ? intval($_GET['id']) : FALSE;
    $right = $this->user->getRight($id_doc);
    if ($id_doc === FALSE || $right === false)
      $this->template->redirect($this->template->language['rights_needed'], TRUE, "/home/index");
    $this->addCss("editor2");
    $this->addJavascript("jquery-ui-1.8.16.custom.min");
    $this->addJavascript("textarea");
    $this->template->setView("editor2");
    $this->template->title = "Editor 2";
    $this->template->doc_id = $id_doc;
    $this->template->doc_name = $this->model->getNameDoc($id_doc);
  }	

  public function changeName()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("header");
    $this->template->loadLanguage("editor2");
    $right = $this->user->getRight($_POST['doc_id']);
    if ($right == "owner" || $right == "write")
      {
	$this->model->modifyNameDoc($_POST['name'], $_POST['doc_id']);
	$this->template->redirect($this->template->language['action_success'], false, "");
      }
    $this->template->redirect($this->template->language['rights_needed'], true, "");
  }
}