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

	public function manageCatAction(){
		$cat = $this->forum->getCat()->rows;
		if (isset($_POST['value']))
		{
			$order = array();
			$i = 0;
			foreach ($_POST['value'] as $value)
			{
				if (array_search($value['id'], $order) === true)
					$this->template->redirect("/adminForum", TRUE, "il y a deja une categorie avec cet ordre");
				$order[$i]['pos'] = $value['order'];
				$order[$i]['id'] = $value['id'];
				$i++;
			}
			$this->forum->reorderCategorie($order);
		}
			$this->template->cat = $cat;
			$this->template->setView("manageCat");
	}

	public function deleteCatAction(){
		if (isset($_GET['id']))
		{
			$id = intval($_GET['id']);
		$this->forum->deleteCategorie($id);
		$this->template->redirect("/adminForum/manageCat", FALSE, "");
	   }	
	}

	public function addForumAction(){
		$this->template->cat = $this->forum->getCat()->rows;
		$this->template->setView("addForum");
	}
}
?>