<?php
class			forumController extends controller
{
  public function indexAction()
  {
  // $moderators = array("test", "test2");
  // $toto = $this->forum->createForum("last_test", 1, 1, 1, 1, 1, $moderators, "test final", 1);
// $id = $this->forum->createTopic($toto, "test", "ceci est un test", "me", "normal");
// $this->forum->createPost("message", "me", $id, 0);
// $this->forum->createPost("message", "me", $id, 0);
// $this->forum->deletePost(30);
// $this->forum->createCategorie("test2", 2);
//$this->forum->createCategorie("test3", 3);
// $first['pos'] = 1;
// $second['pos'] = 2;
// $third['pos'] = 3;
// $first['id'] = 1;
// $second['id'] = 18;
// $third['id'] = 19;
// $array = array($first, $second, $third);
// $this->forum->reorderCategorie($array);
	//$this->forum->deleteForum(2);
	$this->addCss("forum");
	$this->template->ret = $this->forum->getEverything();
	$this->template->setView("forum");
  }
}
?>