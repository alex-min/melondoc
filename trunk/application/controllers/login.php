<?php
class		loginController extends controller
{
  public function indexAction()
  {
    $this->template->loadLanguage("login");
    $this->template->setView("header");
    if ($this->user->connectUser(mysql_real_escape_string($_POST['login']), md5(SALT.$_POST['password'])) == TRUE)
      $this->template->redirect($this->template->language['login_success'].$_SESSION['user']['login'], FALSE, "/home/index");
    else
      $this->template->redirect($this->template->language['login_error'], TRUE, "/index/index");
  }

  public function deconnexion()
  {
    $this->user-disconnectUser();
  }

  public function inscriptionAction()
  {
    $this->template->loadLanguage("login");
    $this->template->setView("header");
    $this->template->setView("inscription");
    if (isset($this->POST))
      {
	if ($this->checkForm($this->POST) != NULL)
	  $this->template->redirect();
	$this->user->addUser($this->POST['form_login'], $this->POST['form_first_name'], $this->POST['form_last_name'], $this->POST['form_email'], md5(SALT.$this->POST['form_password']));
      }
  }
  
  private function checkForm($form)
  {
    // check les erreurs possible a l'inscription et lance une redirection avec une erreur via template->redirect
    $error = NULL;
    $domaines_interdits = array('trashmail.net', 'haltospam.com', 'yopmail.com', 'ephemail.net', 'brefemail.com', 'spamgourmet.com', 'jetable.net', 'jetable.com', 'jetable.org', 'mailinator.com', 'kleemail.com', 'iximail.com', 'spambox.us', 'link2mail.net', 'dodgeit.com', 'golfilla.info', 'senseless-entertainment.com', 'afrobacon.com', 'put2.net', 'mx0.wwwnew.eu', 'temporaryinbox.com', 'yopmail.net', 'cool.fr.nf','jetable.fr.nf','nospam.ze.tc','nomail.xl.cx', 'mega.zik.dj','speed.1s.fr','courriel.fr.nf','moncourrier.fr.nf','monemail.fr.nf','monmail.fr.nf', 'disposableinbox.com', 'tempinbox.com', 'DingBone.com', 'FudgeRub.com', 'BeefMilk.com', 'LookUgly.com', 'SmellFear.com');
    return $error;
  }

}
?>