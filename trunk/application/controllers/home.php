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
  }

  public function	addGroupRights()
  {
    $this->user->needLogin();
    if (isset($_POST['doc_id']) && isset($_POST['group_id']) && isset($_POST['right'])
	&& $this->user->getRight($_POST['doc_id']) !== FALSE)
      {
	$this->model->addGroupRights($_POST['doc_id'], $_POST['group_id'], $_POST['right']);
	$group = $this->user->getGroupFromID($_POST['group_id']);
	$this->template->addJSON($group);
      }
  }

  public function	addUserRights()
  {
    $this->user->needLogin();
    if (isset($_POST['doc_id']) && isset($_POST['user_id']) && isset($_POST['right']) &&
	$this->user->getRight($_POST['doc_id']) !== FALSE)
      {
	$this->model->addUserRights($_POST['doc_id'], $_POST['user_id'], $_POST['right']);
	$user = $this->user->getUserFromID($_POST['user_id']);
	$this->template->addJSON($user);
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
	    return;
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
	    $html .= "<h3 id='u_rights'>".$this->template->language['home_title_ind_rights']."</h3><p>";
	    if ($rights)
	      {
		foreach ($rights AS $r)
		  {
		    if ($r['user_id'] == $_SESSION['user']['user_id'])
		      continue;
		    $change = "disabled=\"disabled\"";
		    if ($myright == "owner")
		      $change = "change=\"header:changeRights\"";
		    $html .= "<p><span class='help-inline'>".$r['login']."</span> <select ".$change." doc_id='".$doc['id_document']."' name='".$r['user_id']."'>";
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
	    $html .= "<h3 id='g_rights'>".$this->template->language['home_title_group_rights']."</h3><p>";
	    if ($groups_rights)
	      {
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
	    $select_right = "<select name='rights_".$doc['id_document']."'><option value='read'>".$this->user->convertRight("read")."</option><option value='write'>".$this->user->convertRight("write")."</option></select>";
	    $html .= "</div><div class='modal-footer'>";
	    $html .= "<h3>".$this->template->language['home_add_rights_user']."</h3>";
	    $html .= "<input type='text' name='rights_user_".$doc['id_document']."' autocomplete='off' onblur='fill_search(\"\", this);' keyup='header:completion_user' doc_id='".$doc['id_document']."'>".$select_right;
	    $html .= '<div class="suggestionsBox" id="suggestions_user_'.$doc['id_document'].'" style="display: none;"><div class="suggestionList" id="autoSuggestionsList_user_'.$doc['id_document'].'">&nbsp;</div></div>';

	    $select_right = "<select name='rights_groups_".$doc['id_document']."'><option value='read'>".$this->user->convertRight("read")."</option><option value='write'>".$this->user->convertRight("write")."</option></select>";
	    $html .= "<h3>".$this->template->language['home_add_rights_group']."</h3>";
	    $html .= "<input type='text' name='rights_group_".$doc['id_document']."' autocomplete='off' onblur='fill_search_group(\"\", this);' keyup='header:completion_group' doc_id='".$doc['id_document']."'>".$select_right;
	    $html .= '<div class="suggestionsBox" id="suggestions_group_'.$doc['id_document'].'" style="display: none;"><div class="suggestionList" id="autoSuggestionsList_group_'.$doc['id_document'].'">&nbsp;</div></div></div></div>';
	    $html .= '<li><a href="/home/deleteDoc?doc='.$doc['id_document'].'"><i class="icon-remove icon-white"></i></a><a data-toggle="modal" href="#rights_'.$doc['id_document'].'"><i class="icon-edit icon-white"></i></a><a href="/editor/?id='.$doc['id_document'].'" rel="'.$doc['id_document'].'">'.$doc['nom'].'</a></li>';
	  }
      $html .= '</ul>';
    }
    echo utf8_encode($html);
    return ;
  }

  public function	getUsersCompletion()
  {
    $this->user->needLogin();
    $letter = $_POST['letter'];
    $doc_id = intval($_POST['id']);
    $res = $this->model->getUsersCompletion($letter);
    $html = "";
    foreach ($res AS $u)
      {
	$html .= "<li onClick=\"fill_search('".$u['user_id']."', '".$doc_id."');\"><div class='label notice'>".$u['firstname']." ".$u['lastname']." (".$u['login'].")</div></li>";
      }
    $this->template->addJSON(array("html" => $html));
  }

  public function	getGroupsCompletion()
  {
    $this->user->needLogin();
    $letter = $_POST['letter'];
    $doc_id = intval($_POST['id']);
    $res = $this->model->getGroupsCompletion($letter);
    $html = "";
    foreach ($res AS $u)
      {
	$html .= "<li onClick=\"fill_search_group('".$u['id_group']."', '".$doc_id."');\"><div class='label notice'>".$u['group_name']."</div></li>";
      }
    $this->template->addJSON(array("html" => $html));
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