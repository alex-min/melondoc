<?php
class     homeController extends controller
{
  public function	indexAction()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("header");
    $this->template->loadLanguage("home");
    $this->template->setView("account");
    $this->template->infos = $_SESSION['user'];
    if (isset($_POST['form_lastname']))
      {

      }
  }

  public function	addGroupRights()
  {
    $this->user->needLogin();
    if (isset($_POST['doc_id']) && isset($_POST['group_id']) && isset($_POST['right'])
	&& $this->user->getRight($_POST['doc_id']) !== FALSE)
  }

  public function	addUserRights()
  {
    $this->user->needLogin();
    if (isset($_POST['doc_id']) && isset($_POST['user_id']) && isset($_POST['right']) &&
	$this->user->getRight($_POST['doc_id']) !== FALSE)
      {
	
      }
  }

  public function	changeRightsUser()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    if (isset($_POST['doc_id']) && isset($_POST['user_id']) && isset($_POST['right'])
	&& $this->user->getRight($_POST['doc_id']) !== FALSE)
      {
	if ($_POST['right'] == "null")
	  {
	    $this->model->delRights(intval($_POST['doc_id']), intval($_POST['user_id']));
	    $this->template->addJSON(array("success_del" => $this->template->language['rights_change']));
	    return ;
	  }
	if ($_POST['right'] != "owner" && $_POST['right'] != "read" && $_POST['right'] != "write")
	  {
	    $this->template->addJSON(array("error" => $this->template->language['error']));
	    return ;
	  }
	$this->model->changeRightUser(intval($_POST['doc_id']), intval($_POST['user_id']), $_POST['right']);
	$this->template->addJSON(array("success" => $this->template->language['rights_change']));
	return ;
      }
    $this->template->addJSON(array("error" => $this->template->language['error']));
  }

  public function	changeRightsGroup()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    if (isset($_POST['doc_id']) && isset($_POST['group_id']) && isset($_POST['right'])
	&& $this->user->getRight($_POST['doc_id']) !== FALSE)
      {
	if ($_POST['right'] == "null")
	  {
	    $this->model->delGroupRights(intval($_POST['doc_id']), intval($_POST['group_id']));
	    $this->template->addJSON(array("success_del" => $this->template->language['rights_change']));
	    return ;
	  }
	if ($_POST['right'] != "read" && $_POST['right'] != "write")
	  {
	    $this->template->addJSON(array("error" => $this->template->language['error']));
	    return ;
	  }
	$this->model->changeRightGroup(intval($_POST['doc_id']), intval($_POST['group_id']), $_POST['right']);
	$this->template->addJSON(array("success" => $this->template->language['rights_change']));
	return ;
      }
    $this->template->addJSON(array("error" => $this->template->language['error']));
  }
    
  public function	getList()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    $html = "";
    if (isset($_POST['dir']) && strlen($_POST['dir']) <= 0)
      {
	$html .= '<ul class="jqueryFileTree">';
	if (($categorie = $this->model->getListCategorie()))
	  foreach ($categorie AS $c)
	    $html .= '<li class="directory collapsed"><a href="#" rel="'.$c['id_category'].'">'.$c['name'].'</a></li>';
	$html .= '</ul>';
      }
    if (isset($_POST['dir']) && strlen($_POST['dir']) > 0)
    {
      $html .= '<ul class="jqueryFileTree">';
      if (($documents = $this->model->getDocumentsFromUserIDAndCategorie($_SESSION['user']['user_id'], $_POST['dir'])))
	foreach ($documents AS $doc)
	  {
	    $rights = $this->model->getRightsFromDocID($doc['id_document']);
	    $html .= "<div class='hide fade in modal' id='rights_".$doc['id_document']."'>";
	    $html .= '<div class="modal-header"><h2>'.$this->template->language['home_edit_rights'].'"'.$doc['nom'].'"</h2></div>';
	    $html .= '<div class="modal-body">';
	    $myright = $this->user->getRight($doc['id_document']);
	    $html .= "<p>".$this->template->language['home_your_rights'].' : '.$this->user->convertRight($myright)."</p>";
	    if ($rights)
	      {
		$html .= "<h3>".$this->template->language['home_title_ind_rights']."</h3><p>";
		foreach ($rights AS $r)
		  {
		    if ($r['user_id'] == $_SESSION['user']['user_id'])
		      continue;
		    $change = "disabled=\"disabled\"";
		    if ($myright == "owner")
		      $change = "change=\"header:changeRights\"";
		    $html .= "<span class='help-inline'>".$r['login']."</span> <select ".$change." doc_id='".$doc['id_document']."' name='".$r['user_id']."'>";
		    $gr = $r['user_right'];
		    $select1 = "";
		    $select2 = "";
		    if ($gr == "read") $select1 = "selected=\"selected\"";
		    else $select2 = "selected=\"selected\"";

		    $html .= "<option ".$select1." value='read'>".$this->user->convertRight("read")."</option>";
		    $html .= "<option ".$select2." value='write'>".$this->user->convertRight("write")."</option>";
		    $html .= "<option value='null'>".$this->template->language['home_delete_rights']."</option>";
		    $html .= "</select>";
		  }
		$html .= "</p>";
	      }
	    $html .= "</p>";
	    $groups_rights = $this->model->getGRightsFromDocID($doc['id_document']);
	    if ($groups_rights)
	      {
		$html .= "<h3>".$this->template->language['home_title_group_rights']."</h3><p>";
		foreach ($groups_rights AS $r)
		  {
		    $change = "disabled=\"disabled\"";
		    if ($myright == "owner")
		      $change = "change=\"header:changeRightsGroups\"";
		    $html .= "<span class='help-inline'>".$r['group_name']."</span> <select ".$change." doc_id='".$doc['id_document']."' name='".$r['id_group']."'>";
		    $gr = $r['group_rights'];
		    $select1 = "";
		    $select2 = "";
		    if ($gr == "read") $select1 = "selected=\"selected\"";
		    else $select2 = "selected=\"selected\"";
		    $html .= "<option ".$select1." value='read'>".$this->user->convertRight("read")."</option>";
		    $html .= "<option ".$select2." value='write'>".$this->user->convertRight("write")."</option>";
		    $html .= "<option value='null'>".$this->template->language['home_delete_rights']."</option>";
		    $html .= "</select>";
		  }
		$html .= "</p>";
	      }
	    $html .= "</div></div>";
	    $html .= '<li><a href="/home/deleteDoc?doc='.$doc['id_document'].'"><i class="icon-remove icon-white"></i></a><a data-toggle="modal" href="#rights_'.$doc['id_document'].'"><i class="icon-edit icon-white"></i></a><a href="/editor/?id='.$doc['id_document'].'" rel="'.$doc['id_document'].'">'.$doc['nom'].'</a></li>';
	  }
      $html .= '</ul>';
    }
    echo utf8_encode($html);
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