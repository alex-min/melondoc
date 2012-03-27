<?php
include_once "sdk_facebook.php";

class		libfacebook
{
  private		$class;
  private		$facebook = null;
  private		$loginUrl;
  private		$logoutUrl;
  private		$uid = false;
  private		$infos;
  private		$isGood = true;

  public function loadLib($class)
  {
    if (is_array($class))
      foreach ($class AS $key => $value)
	$this->$key = $value;
  }

  public function __get($key)
  {
    return ((isset($this->class[$key])) ? $this->class[$key] : NULL);
  }
  
  public function __set($key, $val)
  {
    $this->class[$key] = $val;
  }

  public function	__construct()
  {
  }

  public function	updateFacebook()
  {
    try {
      $this->logoutUrl = $this->facebook->getLogoutUrl();
      $this->uid = $this->facebook->getUser();
      $this->infos = $this->facebook->api("/".$this->uid);
    }
    catch (Exception $e)
      {
	$this->isGood = false;
	$this->template->isGood = false;
      }
  }
  // si on est pas connecte a facebook ou bien si on a pas les droits on redirige l'utilisateurs vers la page facebook pour y remedier et elle nous renvoie a la bonen page sur le site
  public function	needFacebook()
  {
    $this->facebook = new Facebook(array(
				   'appId'  => FB_APPID,
				   'secret' => FB_SECRET_KEY,
				   'fileUpload' => false
				   ));
    $this->updateFacebook();
    return $this->isGood;
  }

  public function	redirectFacebook($url = false)
  {
    if ($url == false)
      $url = $_SERVER['REQUEST_URI'];
    if ($this->isGood == false)
      $this->template->redirect("", false, $this->getLoginUrl($url));
  }

  // supression des infos facebook chez nous
  public function	deconnexionFacebook()
  {
    $this->facebook = new Facebook(array(
					 'appId'  => FB_APPID,
					 'secret' => FB_SECRET_KEY,
					 'fileUpload' => false
					 ));
    if ($this->facebook)
      $this->facebook->destroySession();
    unset($_SESSION['facebook']);
  }

  // recupere les infos de l'utilisateur
  public function	getInfos()
  {
    return $this->infos;
  }
  // recupere l'uid de la session courante
  public function	getID()
  {
    return $this->uid;
  }

  // recupere l'url de connexion pour le cas ou on ne serait pas connecte a facebook ou qu'on aurait pas les permissions pour l'application courante
  public function	getLoginUrl($url)
  {
    $array = array('scope'         => 'email,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown,read_stream',
		   'redirect_uri'  => "http://".$_SERVER['HTTP_HOST'].$url);
    $this->loginUrl = $this->facebook->getLoginUrl($array);
    return $this->loginUrl;
  }

  // ...
  public function	getLogoutUrl()
  {
    return $this->logoutUrl;
  }

  // permet d'effectuer plusieurs requetes FQL en une seule requete CURL
  public function	multiquery($queries)
  {
    try{
      $param = array(
		     'method'    => "fql.multiquery",
		     'queries'     => $queries,
		     'callback'  => ''
		     );
      $fqlResult = $this->facebook->api($param);
      return $fqlResult;
    }
    catch(Exception $o){
      return NULL;
    }
    return NULL;
  }

  // permet de faire une requete FQL
  public function	query($query) // peut etre aussi fql.multiquery
  // les multiqueries ressemblent a ca : 
  {
    try{
      $param = array(
		     'method'    => "fql.query",
		     'query'     => $query,
		     'callback'  => ''
		     );
      $fqlResult = $this->facebook->api($param);
      return $fqlResult;
    }
    catch(Exception $o){
      return NULL;
    }
    return NULL;
  }

  // permet de publier sur le mur de $user un message facebook
  public function	publish($name, $message, $link, $picture, $description, $user = "me")
  {
    if ($user == "me")
      $user = $this->uid;
    try {
      $array = array('message' => $message,
		     'link'    => $link,
		     'picture' => $picture,
		     'name'    => $name,
		     'description'=> $description
		     );
      $publishStream = $this->facebook->api("/$user/feed", 'post', $array);
      return TRUE;
    } catch (FacebookApiException $e) {
      return FALSE;
    }
    return FALSE;
  }

  public function	IDExist($id_facebook)
  {
    $query = $this->db->query('SELECT `id_facebook` FROM `utilisateur` WHERE `id_facebook` = "'.$id_facebook.'" LIMIT 1');
    if ($query->count > 0)
      return true;
    return false;
  }

  public function	updateIDFacebook($id_facebook, $user_id)
  {
    $this->db->query('UPDATE `utilisateur` SET `id_facebook` = "'.$id_facebook.'" WHERE `id_utilisateur` = "'.$user_id.'"');
  }
}
?>