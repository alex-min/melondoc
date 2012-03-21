<?php
class			forumController extends controller
{


  public function indexAction()
  {

// $toto = $this->forum->createForum("last_test", 1, 1, 1, 1, 1, $moderators, "test final", 1);
// $id = $this->forum->createTopic(4, "test", "ceci est un test", "me", "normal");
 // $this->forum->createPost("message", "me", 3, 0);
// $this->forum->createPost("message", "me", 19, 0);
// $this->forum->deletePost(30);
 //$this->forum->createCategorie("test2", 2);
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
	$_SESSION['user']['login'] = "me";
	//$this->addCSS("forum", "design");
	$ret = $this->forum->getEverything();
  //$this->template->view = $this->prepareView($this->ret);

    $cat = 0;
    foreach ($ret->rows as $data)
    {
      if (empty($data['name_forum'])){
        continue;
      }
      if ($cat != $data['id_categorie'])
      {
        $data['name_cat'] = stripslashes(htmlspecialchars($data['name_cat']));
        $cat = $data['id_categorie'];
      }
      $data['moderators'] = unserialize($data['moderators']);
      $data['name_forum'] = stripslashes(htmlspecialchars($data['name_forum']));
      $data['desc'] = nl2br(stripslashes(htmlspecialchars($data['desc'])));
    }

    $this->template->ret = $ret;
  
	$this->template->setView("forum");
  }
  
  public function prepareView($ret)
  {
    $view = "";
    $view .= "<table>";
    $cat = 0;
    $mess = 0;
    $i = 0;

    foreach ($ret->rows as $data)
    {
      if (empty($data['name_forum'])){
        continue;
      }
      if ($cat != $data['id_categorie'])
      {
        $data['name_cat'] = stripslashes(htmlspecialchars($data['name_cat']));
        $cat = $data['id_categorie'];
      }
      $data['moderators'] = unserialize($data['moderators']);
      $data['name_forum'] = stripslashes(htmlspecialchars($data['name_forum']));
      $data['desc'] = nl2br(stripslashes(htmlspecialchars($data['desc'])));
    }

    $this->template->ret = $ret;

    /*foreach ($ret->rows as $data)
    {
      if (empty($data['name_forum'])){
        continue;
      }
      if ($cat != $data['id_categorie'])
      {
        $view .= '<tr>
          <th ><strong>'.stripslashes(htmlspecialchars($data['name_cat'])).'
          </strong></th>             
          <th ><strong>Sujets</strong></th>       
          <th ><strong>Messages</strong></th>       
          <th ><strong>Dernier message</strong></th>   
          </tr>';
        $cat = $data['id_categorie'];
      }
      $mess += $data['nb_reponses'] + $data['nb_topics'];
      $modo = unserialize($data['moderators']);
      $mod ="";
      $view .= "<tr><td class=\"titre\"><strong><a href='/forum/voirForum?id=".$data['id_forum1']."'>".stripslashes(htmlspecialchars($data['name_forum']))."</a></strong><br/>".nl2br(stripslashes(htmlspecialchars($data['desc'])));  
      if (!empty($modo))
      {
        $view .="<br />moderateurs :";  
        $mod = implode(", ", $modo);
        $view .= $mod;
      }
      $view .= "</td><td >".$data['nb_topics']."</td><td >".$data['nb_reponses']."</td><td ><a href=\"/forum/viewTopic?id=".$data['id_topic1']."&amp;post=".$data['last_post']."\">last message</a></td></tr>";
    }
    $view .="</table>";*/
    return $view;
  }


  public function voirForumAction()
  {
  $this->addCSS("forum", "design");
	$id = intval($_GET['id']);
	if (!$this->forum->forumExist($id))
	echo 'error';
	$this->template->topics = $this->forum->getTopicsFromForum($id);
  $this->template->infos = $this->forum->getForumById($id)->row;
  $this->template->linkCreate = '<a href="/forum/createTopic?id='.$id.'">Nouveau Topic</a>';
  $i = 0;
  foreach ($this->template->topics->rows as $value)
  {

    $value['name'] = stripslashes($value['name']);
    $value['date'] = date("Y/M/D", ($value['date']));
    $this->template->topics->rows[$i] = $value;
    $i++;
  }
  $this->template->viewModerator = true;
   $modo = unserialize($this->template->infos['moderators']) ;
   $flag = true;
   if ($modo != false)
  {
  foreach ($modo as $value) {
    if ($value == $_SESSION['user']['login'])
    {
      $flag = true;
      break;
    }
  }
}
  if ($flag == false && $_SESSION['user']['rights'] < $this->forum->getConfigFromKey("right_admin"))
  {
    $this->template->viewModerator = false;
  }

	$this->template->setView("forumView");
	
  }
  
  public function deletePostAction()
  {
	$id = intval($_GET['id']);
	  $this->checkOwner($id);
	if (!$this->forum->postExist($id))
	echo 'error';
	$this->forum->deletePost($id);
	$this->template->redirect("it works", FALSE, $_SERVER["HTTP_REFERER"]);
  }
  
  
  public function editPostAction()
  {
	$id = intval($_GET['id']);
	  $this->checkOwner($id);
	if (!$this->forum->postExist($id))
		$this->template->redirect("ce post n'existe pas", TRUE, getReferer());
	$post = $this->forum->getPost($id)->row;
  $post['message'] = stripslashes(htmlentities($post['message']));
  $this->template->post = $post;
  $this->template->infos = $this->forum->getArianeFromPost($id)->row;
	$this->template->setView("editPost");
  }
  
  public function DoEditPostAction()
  {
  $id = intval($_GET['id']);
  $this->checkOwner($id);
 
  if (!isset($_POST['message']))
	$this->template->redirect("le message est vide.", TRUE, getReferer());
  $message = $_POST['message'];
  $message = mysql_real_escape_string($message);
  $this->forum->editPost($id, $message);
  $this->template->redirect("message editer avec succes.", FALSE, "/forum/");
  }
  
  public function	createTopicAction()
  {
  $_SESSION['user']['rights'] = 3;	
  if (!isset($_GET['id']))
   $this->template->redirect("ce forum n'existe pas", TRUE, "/forum");
  $forum_id = intval($_GET['id']);
  if (!$this->forum->forumExist($forum_id))
  $this->template->redirect("ce forum n'existe pas", TRUE, "/forum");
  $ret = $this->forum->getForumById($forum_id);
  $configRightAdmin = $this->forum->getConfigFromKey("right_post_admin");
   $configRightAnnonce = $ret->row['right_annonce'];
  if ($ret->row['right_create'] > $_SESSION['user']['rights'])
    $this->template->redirect("vous n'avez pas les permissions necessaire", TRUE, "/forum/");

  if (isset($_POST['message']) || isset($_POST['titre']))
  {
	 if (!isset($_POST['message']) || empty($_POST['message']))
	 {
	   $this->template->titre = $_POST['titre'];
	   $this->template->redirect("vous n'avez pas ecris de message", TRUE, "/forum/createTopic?id=".$forum_id);
	 }
	 else if (!isset($_POST['titre']) || empty($_POST['titre']))
	 {
	  $this->template->message = $_POST['message'];
	  $this->template->redirect("vous n'avez pas ecris de message", TRUE, "/forum/createTopic?id=".$forum_id);
	 }
	 else
	 {
     if ($_POST['type'] != "normal")
     {
       if ($_POST['type'] == "Annonce" && $_SESSION['user']['rights'] < $configRightAnnonce)
       $this->template->redirect("vous n'avez pas les permissions necessaire pour poster ce sujet en tant qu'annonce", FALSE, "/forum/createTopic?id=".$forum_id);
         if ($_POST['type'] == "Admin" && $_SESSION['user']['rights'] < $configRightAdmin)
       $this->template->redirect("vous n'avez pas les permissions necessaire pour poster ce sujet en tant qu'Admin", FALSE, "/forum/createTopic?id=".$forum_id);
     }
	   $message = mysql_real_escape_string($_POST['message']);
     $titre = mysql_real_escape_string($_POST['titre']);
     $type = $_POST['type'];
     $id_topic = $this->forum->createTopic($forum_id, $titre, $message, $_SESSION['user']['login'], $type);
     $this->template->redirect("Sujet cree avec succes", FALSE, "/forum/viewTopic?id=".$id_topic);
	 }
  }
  else
  {
	 if (empty($this->template->message))
	   $this->template->message = "";
	 if (empty($this->template->titre))
	   $this->template->titre = "";
  
   
   $this->template->canAdmin = ($_SESSION['user']['rights'] >= $configRightAdmin) ? true : false;
   $this->template->canAnnonce = ($_SESSION['user']['rights'] >= $configRightAnnonce) ? true : false;
	 $this->template->id = $forum_id;
   $this->template->forum_name = $ret->row['name'];
	 $this->template->setView("createTopic");
  }
  }
  
  public function checkOwner($id)
  {
  $_SESSION['user']['rights'] = 0;
  if (!$this->forum->amIOwner($id, $_SESSION['user']['login']) && $_SESSION['user']['rights'] < 1)
    $this->template->redirect("vous n'avez pas les permission necessaire", TRUE, $this->getReferer()); 
  }
  
  public function moderateAction()
  {
    $id = intval($_GET['id']);
      if (!$this->forum->forumExist($id))
    echo 'error';
  $this->addJavascript("forum");
  $this->template->infos = $this->forum->getForumById($id)->row;
  $modo = unserialize($this->template->infos['moderators']) ;

  $flag = false;
  if ($modo != false)
  {
  foreach ($modo as $value) {
    if ($value == $_SESSION['user']['login'])
    {
      $flag = true;
      break;
    }
  }
}
  if ($flag == false && $_SESSION['user']['rights'] < $this->forum->getConfigFromKey("right_admin"))
  {
    $this->template->redirect("Vous n'avez pas les permissions necessaire", TRUE, "/forum/voirForum?id=".$id);
  }

  if (isset($_POST['lock']) || isset($_POST['unlock']))
  {
    $this->lockTopic($_POST, $id);  
  }
  else if (isset($_POST['move']))
  {
    $this->moveTopic($_POST, $id);
  }
  else if (isset($_POST['moveTo']))
  {
    $this->moveTopicTo($_POST['topics'], $_POST['to'], $id);
  }
  else
  {
  $this->template->topics = $this->forum->getTopicsFromForum($id);
  $this->template->linkCreate = '<a href="/forum/createTopic?id='.$id.'">Nouveau Topic</a>';
  $i = 0;
  foreach ($this->template->topics->rows as $value)
  {

    $value['name'] = stripslashes($value['name']);
    $value['date'] = date("Y/M/D", ($value['date']));
    $this->template->topics->rows[$i] = $value;
    $i++;
  }
  $this->template->setView("forumModerateView");
}
  }

  public function lockTopic($a, $id)
  {
    $lock = (isset($a['lock'])) ? 1 : 0;
    if (empty($a['topic']))
       $this->template->redirect("Aucun topic selectionne", TRUE, "/forum/moderate?id=".$id);
     $array_id = @array_keys($a['topic']);
     $this->forum->lockTopicArray($array_id, $lock);
    ($lock == 1) ? $this->template->redirect("Topic lock avec succes", TRUE, "/forum/moderate?id=".$id) : $this->template->redirect("Topic unlock avec succes", TRUE, "/forum/moderate?id=".$id); 

  }

  public function moveTopic($a, $id)
  {
    if (empty($a['topic']))
      $this->template->redirect("Aucun topic selectionne", TRUE, "/forum/moderate?id=".$id);
    $this->template->topics = implode(',', @array_keys($a['topic']));
     $this->template->infos = $this->forum->getForumById($id)->row;
     $this->template->info = $this->forum->getForumsAndCat()->rows;
    $this->template->setView("moveTo");
  }

  public function moveTopicTo($from, $to, $id)
  {
    $id_array = explode(',', $from);
    foreach ($id_array as $value) {
      $this->forum->moveTopic($value, $to);
    }
     $this->template->redirect("Topics deplace avec succes", TRUE, "/forum/moderate?id=".$id);
  }

  public function getReferer()
  {
    //var_dump($_SERVER);
  $ref = "/forum/";
  //tester si $ref contient l'adresse du site.
  //sinon on redirige vers l'index.
  return $ref;
  }
  
  public function postAnswerAction()
  {
    $id_topic = intval($_GET['id']);

    if (!isset($_GET['id']) || !$this->forum->topicExist($id_topic))
    {
      $this->template->redirect("ce topic n'existe pas ou plus", TRUE, "/forum");
    }

    if ($this->forum->isLocked($id_topic))
    {
       $this->template->redirect("ce topic est verrouiller", TRUE, "/forum/viewTopic?id=".$id_topic);
    }

    if (isset($_POST['answer']))
    {
      $_POST['answer'] = trim($_POST['answer']);
      
      if (!empty($_POST['answer']))
      {
      $message = mysql_real_escape_string($_POST['answer']);
      $id_post = $this->forum->createPost($message, $_SESSION['user']['login'], $id_topic, false);
      $this->template->redirect("Message poste avec succes", FALSE, "/forum/viewTopic?id=".$id_topic."#".$id_post);
      }
    else
    {
      $this->template->topic_id = $id_topic;
      $this->template->setView("answerEditor");
    }
  }
  }

  public function viewTopicAction()
  {
  $id_post = 0;
  $_SESSION['user']['rights'] = 3;
  $id_topic = intval($_GET['id']);
   $this->addCSS("forum", "design");
  $this->addJavascript("forum");
	if (!$this->forum->topicExist($id_topic)){
	$this->template->redirect("ce topic n'existe pas ou plus", TRUE, "/forum");
}
	$post = $this->forum->getPostsFromTopic($id_topic);
  $this->template->info = $this->forum->getArianeFromTopic($id_topic)->row;
	$this->pager->setDatas($post->rows);
  $posts = array();
    if (isset($_GET['post']))
    {
   $id_post = intval($_GET['post']);
   $page = $this->pager->getPageFromID($id_post);
   $this->template->redirect("", FALSE, "/forum/viewTopic?id=".$id_topic."&page=".$page."#".$id_post);
  }
	$posts = $this->pager->getResult();
	$this->template->next = $this->pager->getPagination($_SERVER["REQUEST_URI"]);
    

  $i = 0;
  $this->template->posts = array();
  $this->template->canAnswer = ($_SESSION['user']['rights'] >= $this->template->info['right_post']) ? true : false;
  if ($this->forum->isLocked($id_topic))
    $this->template->canAnswer = false;
  foreach ($posts as $value)
  {

    $value['date'] = date("Y/M/D", ($value['date']));
    $value['message'] = nl2br(stripslashes(htmlentities($value['message'])));
    $value['message'] = $this->forum->bbcode($value['message']);
    $posts[$i] = $value;
    //var_dump($this->template->posts);
    $i++;
  }



$this->template->posts = $posts;
$this->template->me = $_SESSION['user']['login'];
	$this->template->setView("topicView");
  }


}
?>