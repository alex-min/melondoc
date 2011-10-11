<?php
class			forumController extends controller
{
  public function indexAction()
  {
  // $moderators = array("test", "test2");
  // $toto = $this->forum->createForum("last_test", 1, 1, 1, 1, 1, $moderators, "test final", 1);
 //$id = $this->forum->createTopic(5, "test", "ceci est un test", "me", "normal");
 // $this->forum->createPost("message", "me", 19, 0);
// $this->forum->createPost("message", "me", 19, 0);
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
	$this->addCSS("forum", "design");
	$this->template->ret = $this->forum->getEverything();
	$this->template->setView("forum");
  }
  
  public function voirForumAction()
  {
  $this->addCSS("forum", "design");
	$id = intval($_GET['id']);
	if (!$this->forum->forumExist($id))
	echo 'error';
	$this->template->topics = $this->forum->getTopicsFromForum($id);
	$this->template->setView("forumView");
	
  }
  
  public function deletePostAction()
  {
	$id = intval($_GET['id']);
	if (!$this->forum->postExist($id))
	echo 'error';
	$this->forum->deletePost($id);
	$this->template->redirect("it works", FALSE, $_SERVER["HTTP_REFERER"]);
  }
  
  public function viewTopicAction()
  {
  $id_post = 0;
  $id_topic = intval($_GET['id']);
   $this->addCSS("forum", "design");
  if (isset($_GET['post']))
  {
  $id_post = intval($_GET['post']);
  
  }
	if (!$this->forum->topicExist($id_topic))
	echo 'error';
	$post = $this->forum->getPostsFromTopic($id_topic);
	$this->pager->setDatas($post->rows);
	$this->template->posts = $this->pager->getResult();
	$this->template->next = $this->pager->getPagination($_SERVER["REQUEST_URI"]);
	$this->template->setView("topicView");
  }
}
?>