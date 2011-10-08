<?php
class	forum 
{
	private $class;
	
  public function	__construct($class)
  {
   foreach ($class AS $key => $value)
	    $this->$key = $value;
  }
	
 public function __get($key)
  {
    return (isset($this->class[$key])) ? $this->class[$key] : NULL;
  }

  public function __set($key, $val)
  {
    $this->class[$key] = $val;
  }

	public function	createCategorie($name, $order)
	{
		$this->db->query("insert into forum_categorie set name = '".$name."', `order` = '".$order."'");
	}
	
	public function	createForum($name, $id_cat, $right_create, $right_view, $right_write, $right_annonce, $moderators, $desc, $order)
	{
		$modo = serialize($moderators);
		$modo = mysql_real_escape_string($modo);
		$this->db->query("insert into forum_forum set id_cat = '".$id_cat."', name = '".$name."', `desc` = '".$desc."', right_create = '".$right_create."', 
		right_post = '".$right_write."', right_view = '".$right_view."', right_annonce = '".$right_annonce."', moderators = '".$modo."', 
		`order` = '".$order."'");
		return mysql_insert_id();
	}
	
	public function createTopic($forum_id, $titre, $message, $user, $genre)
	{
		$message = mysql_real_escape_string(htmlentities($message));
		$titre = mysql_real_escape_string(htmlentities($titre));
		$this->db->query("insert into forum_topic set id_forum = '".$forum_id."', name = '".$titre."', creator = '".$user."', genre = '".$genre."', id_first_post = 0, id_last_post = 0, views = 0, reponses = 0, `lock` = 0");
		$id_topic = mysql_insert_id();
		$id_post = $this->createPost($message, $user, $id_topic, 1);
		$this->db->query("update forum_topic set id_first_post = '".$id_post."', id_last_post = '".$id_post."' where id = '".$id_topic."'");
		$this->db->query("update forum_forum set nb_topics = nb_topics + 1 where id = '".$forum_id."'");
		return $id_topic;
	}
	
	public function createPost($message, $user, $id_topic, $first)
	{
	if ($first)
	{
		$this->db->query("insert into forum_posts set id_topic = '".$id_topic."', message = '".$message."', auteur = '".$user."', date = '".time()."'");
		$id_post = mysql_insert_id();
	}
		else
		{
			$this->db->query("insert into forum_posts set id_topic = '".$id_topic."', message = '".$message."', auteur = '".$user."', date = '".time()."'");
			$id_post = mysql_insert_id();
			$this->db->query("update forum_forum set nb_reponses = nb_reponses + 1, last_post = '".$id_post."' where id = (select id_forum from forum_topic where id = '".$id_topic."')");
			$this->db->query("update forum_topic set reponses = reponses + 1, id_last_post = '".$id_post."' where id = '".$id_topic."'");
		}
		return $id_post;
	}
	
	public function	deletePost($id)
	{
		$ret = $this->db->query("select id_last_post, id_first_post from forum_topic where id = (select id_topic from forum_posts where id = '".$id."')");
		if ($ret->row['id_first_post'] == $ret->row['id_last_post'])
		{
		$this->db->query("update forum_forum set nb_topics = nb_topics - 1 where id = (select id_forum from forum_topic where id = (select id_topic from forum_posts where id = '".$id."'))");
		$this->db->query("delete from forum_topic where id = (select id_topic from forum_posts where id = '".$id."')");
		$this->db->query("delete from forum_posts where id = '".$id."'");
		}
		else if ($ret->row['id_first_post'] == $id)
		{
		$reponse = $this->db->query("select reponses, id from forum_topic where id = (select id_topic from forum_posts where id = '".$id."')");
		$this->db->query("update forum_forum set nb_topics = nb_topics - 1, nb_reponses = (nb_reponses - '".$reponse->row['reponses']."') where id = (select id_forum from forum_topic where id = (select id_topic from forum_posts where id = '".$id."'))");
		$this->db->query("delete from forum_topic where id = (select id_topic from forum_posts where id = '".$id."')");
		$this->db->query("delete from forum_posts where id_topic = '".$reponse->row['id']."'");
		}
		else
		{
		$this->db->query("update forum_topic set reponses = reponses - 1 where id = (select id_topic from forum_posts where id = '".$id."')");
		$forum_topic = $this->db->query("select id_topic from forum_posts where id = '".$id."'");
		$this->db->query("update forum_forum set nb_reponses = nb_reponses - 1 where id = (select id_forum from forum_topic where id = (select id_topic from forum_posts where id = '".$id."'))");
		$this->db->query("delete from forum_posts where id = '".$id."'");
		$this->db->query("update forum_topic set id_last_post = (select id from forum_posts where id_topic = '".$forum_topic->row['id_topic']."' order by id desc limit 0,1)");
		}
	}
	
	public function deleteTopic($id)
	{
		$id = $this->db->query("select id_first_post from forum_topic where id = '".$id."'");
		$this->deletePost($id->row['id_first_post']);
	}
	
	public function deleteForum($id)
	{
		$topics = $this->db->query("select id from forum_topic where id_forum = '".$id."'");
		foreach ($topics->rows as $value)
		$this->deleteTopic($value['id']);
		$this->db->query("delete from forum_forum where id = '".$id."'");
	}
	
	public function	reorderCategorie($array)
	{
		foreach ($array as $value)
		{
			$this->db->query("update forum_categorie set `order` = '".$value['pos']."' where id = '".$value['id']."'");
		}
	}
	
	public function	updateGenre($id, $genre)
	{
		$this->db->query("update forum_topic set genre = '".$genre."' where id = '".$id."'");
	}
	
	public function	reorderForum($array)
	{
		foreach ($array as $value)
		{
			$this->db->query("update forum_forum set `order` = '".$value['pos']."' where id = '".$value['id']."'");
		}
	}
	
	public function	lockTopic($id)
	{
		$this->db->query("update forum_topic set lock = 1 where id = '".$id."'");
	}
	
	public function moveTopic($id, $to_forum_id)
	{
		$topic = $this->db->query("select * from forum_topic where id = '".$id."'");
		$this->db->query("update forum_forum set nb_topics = nb_topics - 1 , nb_reponses = nb_reponses - '".$topic->row['reponses']."' where id = '".$topic->row['id_forum']."'");
		$this->db->query("update forum_forum set nb_topics = nb_topics + 1, nb_reponses = nb_reponses + '".$topic->row['reponses']."' where id = '".$to_forum_id."'");
		$this->db->query("update forum_topic set id_forum = '".$to_forum_id."' where id = '".$id."'");
	}
	
	public function getEverything()
	{
		$get = $this->db->query("select forum_categorie.id as 'id_categorie', forum_categorie.name as 'name_cat', forum_categorie.order as 'cat_order' , forum_forum.id as 'id_forum', forum_forum.id_cat, forum_forum.name as 'name_forum', forum_forum.desc,
		forum_forum.right_view, forum_forum.moderators, forum_forum.last_post, forum_forum.order as 'forum_order', forum_forum.nb_topics, forum_forum.nb_reponses, forum_topic.id as 'id_topic', forum_topic.id_forum, forum_topic.id_last_post,
		forum_posts.id as 'id_post' from forum_categorie
		left join forum_forum on forum_categorie.id = forum_forum.id_cat
		left join forum_posts on forum_forum.last_post = forum_posts.id
		left join forum_topic on forum_posts.id_topic = forum_topic.id
		order by forum_categorie.order, forum_forum.order asc");
		return $get;
	}
	
	public function getForumByName($name)
	{
		$ret = $this->db->query("select * from forum_forum where name = '".$name."'");
		return $ret;
	}
}
?>