<?php
class			userController extends controller 
{
  public function indexAction()
  {
    $this->template->loadLanguage("user");
  }

  public function connexionAction()
  {
    $this->template->loadLanguage("user");
    if (count($this->POST) > 0)
      {
	if ($this->user->connectUser($_POST['email'], $_POST['password']) == TRUE)
	  {
	    $this->template->redirect($this->template->language['login_success'].$_SESSION['user']['login'], FALSE, "/home/index");
	  }
	else
	  $this->template->redirect($this->template->language['login_error'], TRUE, "/index/index");
      }
  }

  public function deconnexionAction()
  {
    $this->user->needLogin();
    $this->user->disconnectUser();
  }

  public function inscriptionAction()
  {
    $this->template->loadLanguage("user");
    $this->template->setView("inscription");
    if (isset($this->POST) && isset($this->POST['form_login']))
      {
	if (($error = $this->checkForm($this->POST)) != NULL)
	  $this->template->redirect($error, TRUE, "/index/index");
	$this->user->addUser($this->POST);
	$this->user->connectUser($this->POST['form_email'], $this->POST['form_mdp']);
      }
    $this->template->redirect("", FALSE, "/home/index");
  }
  
  private function checkForm($POST)
  {
    $this->POST = $POST;
    $domaines_interdits = array('trashmail.net', 'haltospam.com', 'yopmail.com', 'ephemail.net', 'brefemail.com', 'spamgourmet.com', 'jetable.net', 'jetable.com', 'jetable.org', 'mailinator.com', 'kleemail.com', 'iximail.com', 'spambox.us', 'link2mail.net', 'dodgeit.com', 'golfilla.info', 'senseless-entertainment.com', 'afrobacon.com', 'put2.net', 'mx0.wwwnew.eu', 'temporaryinbox.com', 'yopmail.net', 'cool.fr.nf','jetable.fr.nf','nospam.ze.tc','nomail.xl.cx', 'mega.zik.dj','speed.1s.fr','courriel.fr.nf','moncourrier.fr.nf','monemail.fr.nf','monmail.fr.nf', 'disposableinbox.com', 'tempinbox.com', 'DingBone.com', 'FudgeRub.com', 'BeefMilk.com', 'LookUgly.com', 'SmellFear.com');
    $error = "";
    if ($this->POST['form_login'] == NULL || strlen($this->POST['form_login']) < 4 ||
	!preg_match("#^[a-zA-Z0-9-_]{3,}$#", $this->POST['form_login']))
      $error .= $this->template->language['error_login'];
    if ($this->POST['form_mdp'] == NULL || strlen($this->POST['form_mdp']) < 6)
      $error .= $this->template->language['error_mdp'];
    if ($this->POST['form_email'] == NULL || !preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $this->POST['form_email']) || $this->model->emailExist($this->POST['form_email']) == TRUE)
      $error .= $this->template->language['error_mail'];
    list($compte, $domaine) = split("@", $this->POST['form_email'], 2);
    if (in_array($domaine, $domaines_interdits))
      $error .= $this->template->language['error_bidon_mail'];
    if ($this->POST['form_mdp'] != $this->POST['form_mdp2'])
      $error .= $this->template->language['error_mdp2'];
    if (!$this->model->checkUsername($this->POST['form_login']))
      $error .= $this->template->language['error_check_login'];
    /* if ($this->POST['form_last_name'] == NULL || strlen($this->POST['form_last_name']) > 32 || strlen($this->POST['form_last_name']) < 4 || !preg_match("#^[a-zA-Z0-9-]{3,}$#", $this->POST['form_last_name'])) */
    /*   $error .= $this->template->language['error_checklastname']; */
    /* if ($this->POST['form_first_name'] == NULL || strlen($this->POST['form_first_name']) > 32 || strlen($this->POST['form_first_name']) < 4 || !preg_match("#^[a-zA-Z0-9-]{3,}$#", $this->POST['form_first_name'])) */
    /*   $error .= $this->template->language['error_checkfirstname']; */
    return $error;
  }

  public function		contactAction()
  {

    $this->template->loadLanguage("user");
    $this->template->setView("contact");
    if (isset($this->POST['']))
      {
	
	$this->template->redirect($this->template->language['contact_success'], TRUE, "/index/index");
      }
  }
}
?>