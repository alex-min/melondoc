<?php
class		loginController extends controller
{
  public function indexAction()
  {
    $this->template->loadLanguage("login");
    if ($this->user->connectUser() == TRUE)
      $this->template->redirect($this->template->language['login_success'].$_SESSION['user']['login'], FALSE, "/home/index");
    else
      $this->template->redirect($this->template->language['login_error'], TRUE, "/login/index");
  }

  public function inscriptionAction()
  {
    $this->template->loadLanguage("login");
    $this->template->setView("header");
    $this->template->setView("inscription");
    if (isset($this->POST))
      {
	$this->checkForm($this->POST);
	$this->user->addUser($this->POST['form_login'], $this->POST['form_first_name'], $this->POST['form_last_name'], $this->POST['form_email'], $this->POST['form_password']);
      }
  }

  private function checkForm($form)
  {
    // check les erreurs possible a l'inscription et lance une redirection avec une erreur via template->redirect
  }

}
?>