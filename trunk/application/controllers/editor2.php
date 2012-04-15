<?php

class Editor2Controller extends controller
{
  public function indexAction()
  {
    $this->addCss("editor2");
    $this->addJavascript("jquery-ui-1.8.16.custom.min");
    $this->addJavascript("textarea");
    $this->template->setView("editor2");
    $this->template->title = "Editor 2";
    $id_doc = $_GET['id'];
    $this->template->doc_id = $id_doc;
    $this->template->doc_name = $this->model->getNameDoc($id_doc);
  }	

  public function changeName()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("editor2");
    if ($this->user->getRight($_POST['doc_id']) !== FALSE)
      {
	$this->model->modifyNameDoc($_POST['name'], $_POST['doc_id']);
	$this->template->addJSON(array("name" => mysql_real_escape_string($_POST['name'])));
	$this->template->redirect($this->template->language['actions_success'], false, "");
      }
    $this->template->redirect($this->template->language['rights_needed'], true, "");
  }
}