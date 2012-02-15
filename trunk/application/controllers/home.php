<?php
class     homeController extends controller
{
  public function	indexAction() // ici c'est l'home du mec
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    $this->template->setView("home");
    $id = $_SESSION['user']['user_id']; 
    if (isset($_GET['id']))
      $id = intval($_GET['id']);
    $this->addJavascript("home");
    if (($this->template->templates = $this->model->getListTemplate()) == FALSE)
      $this->template->noTemplates = $this->template->language['home_no_templates'];
    if (($documents = $this->model->getListDocumentsFromUserID($_SESSION['user']['user_id'])) !== FALSE)
    {
      $this->pager->setDatas($documents);
      $this->template->documents = $this->pager->getResult();
      $this->template->pagination = $this->pager->getPagination("/home/index");
    }
    else
      $this->template->noDocuments = $this->template->language['home_no_documents'];
  }

  public function	newAction()
  {
    $this->user->needLogin();
    $type = intval($this->GET['type']);
    if ($this->model->verifyTypeTemplate($type) === false)
      $this->template->redirect($this->template->language['home_fail_select_template'], TRUE, "/home/index");
    // ajout du document en bdd
    $doc_id = $this->model->addDocument($type, $_SESSION['user']['user_id'], "untitled document");
    // redirection vers le gestionnaire de document de minett / pierrick
    // $this->template->redirect("", FALSE, "");
  }
  
  public function	deleteDocAction()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    $this->model->deleteDoc($this->GET['doc']);
    if ($this->root->isAjax() === true)
      return ;
    $this->template->redirect($this->template->language['home_success_delete'], FALSE, "/home/index");
  }
}
?>