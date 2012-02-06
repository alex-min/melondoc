<?php
class			homeController extends controller
{
  public function	indexAction() // ici c'est l'home du mec
  {
    $this->template->loadLanguage("home");
  }
  
  public function	listAction()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    $this->template->setView("home");
    $id = $_SESSION['user']['user_id']; 
    if (isset($_GET['id']))
      $id = intval($_GET['id']);
    $this->addJavascript("home");
    if (($documents = $this->model->getListDocumentsFromUserID($_SESSION['user']['user_id'])) !== FALSE)
      {
	$this->pager->setDatas($documents);
	$this->template->documents = $this->pager->getResult();
	$this->template->pagination = $this->pager->getPagination("/home/index");
      }
    else
      $this->template->noDocuments = $this->template->language['home_no_documents'];
  }
  
  public function	deleteDocAjax()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    foreach ($this->POST['doc'] AS $key => $val)
      $this->model->deleteDoc($key);
  }
}
?>