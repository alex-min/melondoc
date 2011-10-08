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
	//$this->addCSS("forum", "design");
	$ret = $this->forum->getEverything();
	$cat = 0;
	foreach ($ret->rows as $data)
	{
	  if ($cat != $data['id_categorie'])
	    {
	      $cat = $data['id_categorie'];
	      echo '<tr>
        <th class="titre"><strong>'.stripslashes(htmlspecialchars($data['name_cat'])).'
        </strong></th>             
        <th class="nombremessages"><strong>Sujets</strong></th>       
        <th class="nombresujets"><strong>Messages</strong></th>       
        <th class="derniermessage"><strong>Dernier message</strong></th>   
        </tr><br>';
		}
		// echo 'toto';
		echo'<tr><td>[]</td>
    <td class="titre"><strong>
    <a href="./voirforum.php?f='.$data['id_forum'].'">
    '.stripslashes(htmlspecialchars($data['name_forum'])).'</a></strong>
    <br />'.nl2br(stripslashes(htmlspecialchars($data['desc']))).'</td>
    <td class="nombresujets">'.$data['nb_topics'].'</td>
    <td class="nombremessages">'.$data['nb_reponses'].'</td>';
	    //print_r($data);
	}
  }
}
?>