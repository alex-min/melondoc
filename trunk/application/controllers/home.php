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



  public function	groupsAction()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    $groups = $this->user->getMyGroups();
    $html = "";
    if ($groups)
      {
	$i = 0;
	foreach ($groups AS $g)
	  {
	    $html .= "<tr><td><a href='#' click='groups:delGroups' id_group='".$g['id_group']."'><i class='icon-remove'></i></a></td><td><a href='#' click='groups:showSearch' search_id='".$i."'><i class='icon-plus'></i></a></td><td><a href='#' data-toggle='modal'><i class='icon-user'></i></a></td><td>".$g['group_name']."</td><td><input class='hide input_search_group' type='text' id='searchG_".$i."' group_id='".$g['id_group']."'/><span class='help-inline'><a id='searchB_".$i."' href='#' click='groups:searchUser' search_id='".$i."' class='btn_search_group hide btn btn-primary'>Ok</a></span><div id='search_result_".$i."' class='search_result_group'></div></td></tr>";
	    $i++;
	  }
	$this->template->pageGroup = $html;
      }
    else
      $this->template->pageGroup = $this->template->language['home_no_groups'];
    $this->template->setView("groups");
  }
  
  public function	createGroup()
  {
    $this->user->needLogin();
    if (!isset($_POST['name']))
      $name = "new group";
    else
      $name = mysql_real_escape_string($_POST['name']);
    $id = $this->model->createGroup($name, $_SESSION['user']['user_id']);
    $html = "<<tr><td><a href='#' click='groups:delGroups' id_group='".$id."'><i class='icon-remove'></i></a></td><td><a href='#'><i class='icon-edit'></i></a></td><td>".$name."</td></tr>";
    $this->template->addJSON(array("html" => $html));
  }

  public function	delGroups()
  {
    $this->user->needLogin();
    if (!isset($_POST['id']))
      $this->template->redirect($this->template->language['rights_needed'], TRUE, "/home/groups");
    $id = intval($_POST['id']);
    $group = $this->user->getGroupFromID($id);
    if (!$group || $group['id_owner'] != $_SESSION['user']['user_id'])
      $this->template->redirect($this->template->language['rights_needed'], TRUE, "/home/groups");
    $this->model->delGroup($id);
    $this->template->redirect($this->template->language['action_success'], FALSE, "/home/groups");
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
	    $html .= "<div class='hide modal fade in' id='rights_".$doc['id_document']."'>";
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
	    $html .= '<li><a href="/home/deleteDoc?doc='.$doc['id_document'].'"><i class="icon-remove"></i></a><a data-toggle="modal" href="#rights_'.$doc['id_document'].'"><i class="icon-edit"></i></a><a href="/editor2/?id='.$doc['id_document'].'" rel="'.$doc['id_document'].'">'.$doc['nom'].'</a></li>';
	  }
      $html .= '</ul>';
    }
    echo utf8_encode($html);
    exit;
  }

  public function	getUsersCompletion()
  {
    $this->user->needLogin();
    $letter = $_POST['letter'];
    $doc_id = intval($_POST['id']);
    $res = $this->model->getUsersCompletion($letter);
    $html = "";
    if ($res)
      foreach ($res AS $u)
	{
	  $html .= "<li onClick=\"fill_search('".$u['user_id']."', '".$doc_id."');\"><div class='label notice'>".$u['firstname']." ".$u['lastname']." (".$u['login'].")</div></li>";
	}
    $this->template->addJSON(array("html" => $html));
  }

  public function	getUsersGroupsCompletion()
  {
    $this->user->needLogin();
    $letter = $_POST['letter'];
    $doc_id = intval($_POST['group_id']);
    $res = $this->model->getUsersCompletion($letter);
    $html = "";
    if ($res)
      foreach ($res AS $u)
	{
	  $html .= "<li click='groups:addUserGroup' group_id='".$doc_id."' user_id='".$u['user_id']."' style='cursor:pointer;'><div class='label notice'>".$u['firstname']." ".$u['lastname']." (".$u['login'].")</div></li>";
	}
    $this->template->addJSON(array("html" => $html));
  }

  public function	addUserToGroup()
  {
    $this->user->needLogin();
    if (!isset($_POST['user_id']) || !isset($_POST['group_id']))
      $this->template->redirect($this->template->language['rights_needed'], TRUE, "/home/groups");
    $user_id = intval($_POST['user_id']);
    $group_id = intval($_POST['group_id']);
    if (($user = $this->model->getUserGroup($group_id, $user_id)) === FALSE)
      {
	$this->model->addUserToGroups($group_id, $user_id);
	$this->template->redirect($this->template->language['action_success'], FALSE, "/home/groups");
      }
    $this->template->redirect($this->template->language['already_added'], TRUE, "/home/groups");
  }

  public function	getGroupsCompletion()
  {
    $this->user->needLogin();
    $letter = $_POST['letter'];
    $doc_id = intval($_POST['id']);
    $res = $this->model->getGroupsCompletion($letter);
    $html = "";
    if ($res)
      foreach ($res AS $u)
	{
	  $html .= "<li onClick=\"fill_search_group('".$u['id_group']."', '".$doc_id."');\"><div class='label notice'>".$u['group_name']."</div></li>";
	}
    $this->template->addJSON(array("html" => $html));
  }
 
 public function	createAction()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");

    $categories = $this->model->getListCategorie();

    $document_type = array();
    $document_element = array();

    foreach ($categories as $key => $value) {
      $document_element["name"] = $value['name'];
      $document_element["description"] = $value['description'];
      $document_element["value"] = $value['id_category'];
      array_push($document_type, $document_element);
    }

    $this->template->document_type = $document_type;

    if (isset($this->GET) && isset($this->GET['type']) && !empty($this->GET['type'])){

      $this->newAction();
    }
    $this->template->setView("new");
    $this->template->categorie = $this->model->getListCategorie();
  }

  public function	newAction()
  {
    $this->user->needLogin();
    $type = intval($this->GET['type']);
    if ($this->model->verifyTypeCategorie($type) === false)
      $this->template->redirect($this->template->language['home_fail_select_template'], TRUE, "/home/index");
    // ajout du document en bdd
    $doc_id = $this->model->addDocument($type, $_SESSION['user']['user_id'], "untitled document");
    $this->user->stockMyRights();
    // redirection vers le gestionnaire de document de minett / pierrick
    $this->template->redirect("", FALSE, "/editor2/index?id=".$doc_id);
  }
  
  public function	deleteDocAction()
  {
    $this->user->needLogin();
    $this->template->loadLanguage("home");
    $this->model->deleteDoc(intval($this->GET['doc']));
    if ($this->root->isAjax() === true)
      return ;
    $this->template->redirect($this->template->language['home_success_delete'], FALSE, "/home/index");
  }
}
?>