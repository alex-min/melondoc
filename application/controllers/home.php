<?php
class     homeController extends controller
{
  public function	indexAction()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    $this->template->setView("account.html");
    
  }
    
  public function	getList()
  {
    $this->user->needLogin();
    if (isset($_POST['dir']) && strlen($_POST['dir']) <= 0)
      {
	echo '<ul class="jqueryFileTree">';
	if (($categorie = $this->model->getListCategorie()))
	  foreach ($categorie AS $c)
	    echo '<li class="directory collapsed"><a href="#" rel="'.$c['id_category'].'">'.$c['name'].'</a></li>';
	echo '</ul>';
      }
    if (isset($_POST['dir']) && strlen($_POST['dir']) > 0)
      {
	echo '<ul class="jqueryFileTree">';
	if (($documents = $this->model->getDocumentsFromUserIDAndCategorie($_SESSION['user']['user_id'], $_POST['dir'])))
	  foreach ($documents AS $doc)
	    echo '<li class="file ext_txt"><a href="#" rel="'.$doc['id_document'].'">'.$doc['nom'].'</a></li>';
	echo '</ul>';
      }
    return ;
  }

  public function	listAction() // ici c'est l'home du mec
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    $this->template->setView("home");
    $id = $_SESSION['user']['user_id']; 
    if (isset($_GET['id']))
      $id = intval($_GET['id']);
    $this->addJavascript("home");
  }

  public function	newAction()
  {
    $this->user->needLogin();
    $type = intval($this->GET['type']);
    if ($this->model->verifyTypeCategorie($type) === false)
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