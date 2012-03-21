<?php
class			adminForumController extends controller
{
	public function indexAction(){
		if ($_SESSION['user']['rights'] < $this->forum->getConfigFromKey("right_admin"))
			$this->template->redirect("Vous n'avez pas les permissions necessaires", TRUE, "/forum/");
		$this->template->setView("adminForumIndex");
	}

	public function addCatAction() {
		if (isset($_POST['cat_name']))
		{
			$ret = $this->forum->getCatMaxOrder();
			$this->forum->createCategorie($_POST['cat_name'], $ret->row['max'] + 1);
			$this->template->redirect("/adminForum", FALSE, "categorie ajoute avec succes");
		}
		else
		{
			$this->template->setView("addCat");
		}
	}

	publilc function manageCatAction(){
		if (isset($this->POST['sup']))
		{
			$id = 19;
			$array = @array_keys($this->POST['sup']);
			echo json_encode(array('toto'=> 'test'));
			foreach ($array as $value) {
				$id = $value;
			}
			
			//exit(1);
			//$this->forum->deleteCategorie($id);
		}
		else {
			$this->template->cat = $this->forum->getCat()->rows;
			$this->template->setView("manageCat");
		}
	}
}
?>